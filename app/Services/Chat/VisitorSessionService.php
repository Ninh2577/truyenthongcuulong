<?php

namespace App\Services\Chat;

use App\Models\ChatVisitor;
use App\Models\ChatVisitorSession;
use Illuminate\Support\Str;

class VisitorSessionService
{
    /**
     * Generate a cryptographically secure 256-bit random session token.
     */
    public function generateToken(): string
    {
        return bin2hex(random_bytes(32));
    }

    /**
     * Compute SHA-256 hash of a plaintext token for secure database storage.
     */
    public function hashToken(string $token): string
    {
        return hash('sha256', $token);
    }

    /**
     * Create a new ChatVisitor record.
     */
    public function createVisitor(array $attributes = []): ChatVisitor
    {
        return ChatVisitor::create([
            'visitor_uuid' => (string) Str::uuid(),
            'name' => $attributes['name'] ?? null,
            'phone' => $attributes['phone'] ?? null,
            'email' => $attributes['email'] ?? null,
            'first_ip' => $attributes['first_ip'] ?? null,
            'user_agent' => $attributes['user_agent'] ?? null,
        ]);
    }

    /**
     * Create a new session for the given visitor.
     * Only the SHA-256 hash is persisted in the database.
     */
    public function createSession(ChatVisitor $visitor, ?string $rawToken = null): array
    {
        $rawToken = $rawToken ?: $this->generateToken();
        $ttlDays = (int) config('chat.visitor_session_ttl_days', 30);

        $session = $visitor->sessions()->create([
            'token_hash' => $this->hashToken($rawToken),
            'expires_at' => now()->addDays($ttlDays),
            'last_active_at' => now(),
        ]);

        return [
            'visitor' => $visitor,
            'session' => $session,
            'session_token' => $rawToken,
        ];
    }

    /**
     * Authenticate a visitor by their plaintext session token.
     * Returns the active ChatVisitorSession with loaded visitor, or null if invalid/expired/blocked.
     */
    public function authenticate(string $rawToken): ?ChatVisitorSession
    {
        $tokenHash = $this->hashToken($rawToken);

        $session = ChatVisitorSession::with('visitor')
            ->where('token_hash', $tokenHash)
            ->first();

        if (! $session) {
            return null;
        }

        // Verify expiration
        if ($session->expires_at->isPast()) {
            return null;
        }

        // Verify visitor is active and not blocked
        if (! $session->visitor || $session->visitor->blocked_at !== null) {
            return null;
        }

        // Update last_active_at timestamp without altering updated_at
        $session->forceFill(['last_active_at' => now()])->saveQuietly();

        return $session;
    }

    /**
     * Initialize or resume a visitor session idempotently.
     */
    public function initSession(?string $existingToken = null, array $clientMetadata = []): array
    {
        if (! empty($existingToken)) {
            $tokenHash = $this->hashToken($existingToken);
            $session = ChatVisitorSession::with('visitor')
                ->where('token_hash', $tokenHash)
                ->first();

            if ($session && $session->visitor) {
                // If the visitor is blocked, do not resume
                if ($session->visitor->blocked_at !== null) {
                    return [
                        'blocked' => true,
                        'visitor' => $session->visitor,
                    ];
                }

                // If session is still valid, reuse existing session
                if ($session->expires_at->isFuture()) {
                    $session->forceFill(['last_active_at' => now()])->saveQuietly();

                    return [
                        'blocked' => false,
                        'visitor' => $session->visitor,
                        'session' => $session,
                        'session_token' => $existingToken,
                        'is_new' => false,
                    ];
                }

                // If session expired, create a fresh session for the existing visitor
                $newSessionData = $this->createSession($session->visitor);
                $newSessionData['blocked'] = false;
                $newSessionData['is_new'] = false;

                return $newSessionData;
            }
        }

        // Fresh visitor initialization
        $visitor = $this->createVisitor([
            'first_ip' => $clientMetadata['ip'] ?? null,
            'user_agent' => $clientMetadata['user_agent'] ?? null,
        ]);

        $sessionData = $this->createSession($visitor);
        $sessionData['blocked'] = false;
        $sessionData['is_new'] = true;

        return $sessionData;
    }

    /**
     * Revoke a visitor session by its plaintext token.
     */
    public function revokeSession(string $rawToken): bool
    {
        $tokenHash = $this->hashToken($rawToken);

        return (bool) ChatVisitorSession::where('token_hash', $tokenHash)->delete();
    }

    /**
     * Check if a token belongs to an explicitly blocked visitor.
     */
    public function isTokenOfBlockedVisitor(string $rawToken): bool
    {
        $tokenHash = $this->hashToken($rawToken);

        $session = ChatVisitorSession::with('visitor')
            ->where('token_hash', $tokenHash)
            ->first();

        return (bool) ($session && $session->expires_at->isFuture() && $session->visitor && $session->visitor->blocked_at !== null);
    }
}
