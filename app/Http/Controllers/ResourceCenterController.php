<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class ResourceCenterController extends Controller
{
    public function index(Request $request): View
    {
        $query = Post::with('category')
            ->where('status', 'published')
            ->inPillar('resource');

        if ($request->filled('q')) {
            $s = $request->input('q');
            $query->where('title', 'like', "%{$s}%");
        }

        $resources = $query->orderByDesc('published_at')->paginate(12)->withQueryString();

        return view('resources.index', compact('resources'));
    }

    public function downloadLead(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:100',
            'slug' => 'required|string',
        ]);

        Contact::create([
            'fullname' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'] ?? null,
            'service_interested' => 'download-' . $validated['slug'],
            'message' => 'Yêu cầu tải tài nguyên: ' . $validated['slug'],
            'status' => 'new',
            'ip_address' => $request->ip(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Xác thực thông tin thành công! Đang chuyển tiếp để tải tài nguyên...',
            'download_url' => route('blog.show', $validated['slug']),
        ]);
    }
}
