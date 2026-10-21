<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Services\CustomerIdentityResolver;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('contact');
    }

    /**
     * Xử lý gửi yêu cầu tư vấn tập trung từ mọi form Client Website.
     * Hỗ trợ cả Standard POST Submit (Redirect) và AJAX/Fetch (JSON Response).
     */
    public function submit(Request $request, CustomerIdentityResolver $identityResolver): JsonResponse|RedirectResponse
    {
        // Nhận diện request AJAX / JSON
        $isAjax = $request->ajax()
            || $request->wantsJson()
            || $request->isJson()
            || $request->header('Accept') === 'application/json'
            || $request->hasHeader('X-Requested-With');

        // Chuẩn hóa tên trường alias từ các form khác nhau (name -> fullname, service -> service_interested)
        $rawName = $request->input('fullname') ?: $request->input('name');
        $rawPhone = $request->input('phone');
        $rawEmail = $request->input('email');
        $rawService = $request->input('service_interested') ?: $request->input('service');
        $rawMessage = $request->input('message');
        $rawChannel = $request->input('channel');
        $rawSourceUrl = $request->input('source_url') ?: $request->header('referer') ?: url()->previous();

        $payload = [
            'fullname' => is_string($rawName) ? trim(strip_tags($rawName)) : null,
            'phone' => is_string($rawPhone) ? trim(strip_tags($rawPhone)) : null,
            'email' => is_string($rawEmail) && trim($rawEmail) !== '' ? trim(strip_tags($rawEmail)) : null,
            'service_interested' => is_string($rawService) ? trim(strip_tags($rawService)) : null,
            'message' => is_string($rawMessage) && trim($rawMessage) !== '' ? trim(strip_tags($rawMessage)) : null,
        ];

        $validator = Validator::make($payload, [
            'fullname' => 'required|string|max:100',
            'phone' => 'required|string|min:8|max:30',
            'email' => 'nullable|email|max:100',
            'service_interested' => 'nullable|string|max:150',
            'message' => 'nullable|string|max:3000',
        ], [
            'fullname.required' => 'Vui lòng nhập họ và tên của bạn.',
            'phone.required' => 'Vui lòng nhập số điện thoại liên hệ.',
            'phone.min' => 'Số điện thoại không hợp lệ.',
            'email.email' => 'Địa chỉ email không đúng định dạng.',
        ]);

        if ($validator->fails()) {
            if ($isAjax) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first(),
                    'errors' => $validator->errors(),
                ], 422);
            }

            return back()->withErrors($validator)->withInput();
        }

        // Tự động sinh nội dung nếu form gửi nhanh không có trường message
        $finalMessage = !empty($payload['message'])
            ? $payload['message']
            : ('Khách hàng gửi yêu cầu tư vấn quan tâm: ' . ($payload['service_interested'] ?: 'Dịch vụ Truyền Thông Cửu Long'));

        // Phân loại nguồn/kênh (channel)
        $channel = $rawChannel;
        if (empty($channel)) {
            $sourceLower = strtolower($rawSourceUrl);
            if (str_contains($sourceLower, 'booking')) {
                $channel = 'website_booking';
            } elseif (str_contains($sourceLower, 'kho-giao-dien') || str_contains($sourceLower, 'mau-giao-dien') || str_contains($sourceLower, 'templates')) {
                $channel = 'website_template';
            } elseif (str_contains($sourceLower, 'dich-vu')) {
                $channel = 'website_service';
            } elseif (str_contains($sourceLower, 'lien-he')) {
                $channel = 'website_contact';
            } else {
                $channel = 'website_unknown';
            }
        }

        // Customer Identity Resolution
        $visitor = $identityResolver->resolveForConsultation($payload, $request);
        $normPhone = $identityResolver->normalizePhone($payload['phone']);
        $normEmail = $identityResolver->normalizeEmail($payload['email']);

        // Lưu bản ghi tư vấn
        $contact = Contact::create([
            'fullname' => $payload['fullname'],
            'phone' => $payload['phone'],
            'phone_normalized' => $normPhone,
            'email' => $payload['email'],
            'email_normalized' => $normEmail,
            'service_interested' => $payload['service_interested'],
            'channel' => $channel,
            'source_url' => $rawSourceUrl,
            'message' => $finalMessage,
            'status' => 'new',
            'ip_address' => $request->ip(),
            'chat_visitor_id' => $visitor?->id,
        ]);

        $successMsg = 'Yêu cầu tư vấn đã được gửi thành công. Đội ngũ Truyền Thông Cửu Long sẽ liên hệ lại trong thời gian sớm nhất!';

        if ($isAjax) {
            return response()->json([
                'success' => true,
                'message' => $successMsg,
                'contact_id' => $contact->id,
                'chat_visitor_id' => $visitor?->id,
            ], 200);
        }

        return back()->with('success', $successMsg);
    }
}