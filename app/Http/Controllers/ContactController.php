<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('contact');
    }

    public function submit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:100',
            'phone' => 'required|string|max:30',
            'email' => 'nullable|email|max:100',
            'service_interested' => 'nullable|string|max:100',
            'message' => 'required|string|max:2000',
        ]);

        $validated['ip_address'] = $request->ip();

        Contact::create($validated);

        return back()->with('success', 'Cảm ơn bạn đã liên hệ! Đội ngũ Truyền Thông Cửu Long sẽ phản hồi trong vòng 15-30 phút.');
    }
}