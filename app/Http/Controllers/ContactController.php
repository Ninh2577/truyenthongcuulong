<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Services\CustomerIdentityResolver;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
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

        $cleanPhone = is_string($rawPhone) ? trim(strip_tags($rawPhone)) : null;
        $cleanEmail = is_string($rawEmail) ? trim(strip_tags($rawEmail)) : null;

        // Xử lý thông minh khi người dùng điền Email vào ô Số điện thoại (ở footer hoặc form kết hợp)
        if (!empty($cleanPhone)) {
            if (str_contains($cleanPhone, '@')) {
                if (empty($cleanEmail)) {
                    $cleanEmail = $cleanPhone;
                }
                $cleanPhone = null;
            } elseif (preg_match('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', $cleanPhone, $matches)) {
                if (empty($cleanEmail)) {
                    $cleanEmail = $matches[0];
                }
                $cleanPhone = trim(str_replace($matches[0], '', $cleanPhone));
                if (strlen(preg_replace('/[^0-9]/', '', $cleanPhone)) < 8) {
                    $cleanPhone = null;
                }
            }
        }

        $payload = [
            'fullname' => is_string($rawName) ? trim(strip_tags($rawName)) : null,
            'phone' => !empty($cleanPhone) ? $cleanPhone : null,
            'email' => !empty($cleanEmail) ? $cleanEmail : null,
            'service_interested' => is_string($rawService) ? trim(strip_tags($rawService)) : null,
            'message' => is_string($rawMessage) && trim($rawMessage) !== '' ? trim(strip_tags($rawMessage)) : null,
        ];

        $validator = Validator::make($payload, [
            'fullname' => 'required|string|min:2|max:100',
            'phone' => 'nullable|string|max:30',
            'email' => 'nullable|string|max:100',
            'service_interested' => 'nullable|string|max:150',
            'message' => 'nullable|string|max:3000',
        ], [
            'fullname.required' => 'Vui lòng nhập họ và tên của bạn.',
            'fullname.min' => 'Họ và tên quá ngắn. Vui lòng nhập ít nhất 2 ký tự.',
            'fullname.max' => 'Họ và tên không được vượt quá 100 ký tự.',
            'phone.max' => 'Số điện thoại không được vượt quá 30 ký tự.',
            'email.max' => 'Địa chỉ email không được vượt quá 100 ký tự.',
            'service_interested.max' => 'Dịch vụ quan tâm không hợp lệ.',
            'message.max' => 'Nội dung tin nhắn quá dài (tối đa 3000 ký tự).',
        ]);

        $validator->after(function ($validator) use ($payload, $request) {
            // 1. Kiểm tra nếu cả phone và email đều trống
            if (empty($payload['phone']) && empty($payload['email'])) {
                $msg = 'Vui lòng nhập Số điện thoại hoặc Email để chúng tôi có thể liên hệ hỗ trợ bạn.';
                $validator->errors()->add('phone', $msg);
                $validator->errors()->add('email', $msg);
                return;
            }

            // 2. Kiểm tra tính hợp lệ của Phone (nếu có nhập)
            if (!empty($payload['phone'])) {
                $rawP = $payload['phone'];
                $cleanChars = preg_replace('/[0-9\s\.\-\+\(\)]/', '', $rawP);
                $digits = preg_replace('/[^0-9]/', '', $rawP);

                if (!empty($cleanChars) || strlen($digits) < 9 || strlen($digits) > 11) {
                    $msg = 'Số điện thoại không hợp lệ. Vui lòng nhập số điện thoại gồm 9 - 11 chữ số (ví dụ: 0939 363 262).';
                    $validator->errors()->add('phone', $msg);
                }
            }

            // 3. Kiểm tra tính hợp lệ của Email (nếu có nhập)
            if (!empty($payload['email'])) {
                if (!filter_var($payload['email'], FILTER_VALIDATE_EMAIL) || !str_contains($payload['email'], '.')) {
                    $msg = 'Địa chỉ email không đúng định dạng (ví dụ: tenban@gmail.com).';
                    $validator->errors()->add('email', $msg);
                    if ($request->has('phone') && !$request->has('email')) {
                        $validator->errors()->add('phone', $msg);
                    }
                }
            }
        });

        // Xác định channel sớm để gắn vào session nếu có lỗi
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

        if ($validator->fails()) {
            if ($isAjax) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first(),
                    'errors' => $validator->errors(),
                ], 422);
            }

            return back()->withErrors($validator)->withInput()->with('error_channel', $channel);
        }

        try {

            // Customer Identity Resolution an toàn tuyệt đối
            $visitor = null;
            try {
                $visitor = $identityResolver->resolveForConsultation($payload, $request);
            } catch (\Throwable $e) {
                Log::warning('Customer identity resolution failed: ' . $e->getMessage());
            }

            $normPhone = $payload['phone'] ? $identityResolver->normalizePhone($payload['phone']) : null;
            $normEmail = $payload['email'] ? $identityResolver->normalizeEmail($payload['email']) : null;

            // Lưu bản ghi tư vấn với giới hạn chuỗi bảo vệ database
            $contact = Contact::create([
                'fullname' => Str::limit($payload['fullname'], 100, ''),
                'phone' => $payload['phone'] ? Str::limit($payload['phone'], 30, '') : null,
                'phone_normalized' => $normPhone ? Str::limit($normPhone, 30, '') : null,
                'email' => $payload['email'] ? Str::limit($payload['email'], 100, '') : null,
                'email_normalized' => $normEmail ? Str::limit($normEmail, 150, '') : null,
                'service_interested' => $payload['service_interested'] ? Str::limit($payload['service_interested'], 150, '') : null,
                'channel' => Str::limit($channel ?: 'website', 50, ''),
                'source_url' => Str::limit($rawSourceUrl, 500, ''),
                'message' => Str::limit($payload['message'] ?: ($rawMessage ? trim(strip_tags($rawMessage)) : 'Yêu cầu tư vấn dịch vụ'), 3000, ''),
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

            return back()->with('success', $successMsg)->with('channel', $channel);
        } catch (\Throwable $e) {
            Log::error('Contact submit fatal error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'payload' => $payload,
            ]);

            $friendlyError = 'Hệ thống đang bận. Vui lòng thử lại sau hoặc gọi hotline 0939.363.262 để được hỗ trợ tức thì!';

            if ($isAjax) {
                return response()->json([
                    'success' => false,
                    'message' => $friendlyError,
                ], 422);
            }

            return back()->withErrors(['general' => $friendlyError])->withInput();
        }
    }
}