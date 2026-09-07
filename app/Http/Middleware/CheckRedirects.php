<?php

namespace App\Http\Middleware;

use App\Models\Redirect;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRedirects
{
    public function handle(Request $request, Closure $next): Response
    {
        $path = '/' . ltrim($request->path(), '/');

        $redirect = Redirect::where('old_url', $path)
            ->orWhere('old_url', $path . '/')
            ->first();

        if ($redirect) {
            $redirect->increment('hits');
            return redirect($redirect->new_url, $redirect->status_code ?: 301);
        }

        return $next($request);
    }
}