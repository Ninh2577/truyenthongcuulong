<?php

namespace Database\Seeders;

use App\Enums\ChatConversationChannel;
use App\Enums\ChatConversationStatus;
use App\Enums\ChatMessageSenderType;
use App\Enums\ChatMessageStatus;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Models\ChatVisitor;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ChatInboxDesignSeeder extends Seeder
{
    public function run(): void
    {
        $agent = User::where('email', 'admin@truyenthongcuulong.com')->first() ?? User::first();
        $agentId = $agent ? $agent->id : null;

        $conversationsData = [
            [
                'name' => 'Nguyễn Văn Hải',
                'phone' => '0939 123 456',
                'email' => 'hainguyen@gmail.com',
                'city' => 'Hà Nội',
                'interest' => 'Đang tìm hiểu dịch vụ website',
                'channel' => 'Website',
                'status' => 'waiting_agent', // Chưa trả lời
                'status_label' => 'Chưa trả lời',
                'unread' => 3,
                'time_ago' => 10, // minutes
                'tags' => ['Khách hàng tiềm năng', 'Website', 'Bất động sản'],
                'messages' => [
                    [
                        'sender' => 'visitor',
                        'body' => 'Chào anh, em muốn được tư vấn về gói website doanh nghiệp. Công ty em đang cần làm website để giới thiệu sản phẩm và dịch vụ.',
                        'minutes_ago' => 18,
                        'time_str' => '09:42',
                    ],
                    [
                        'sender' => 'visitor',
                        'body' => 'Cho em hỏi công ty mình có hỗ trợ thiết kế theo yêu cầu không ạ?',
                        'minutes_ago' => 15,
                        'time_str' => '09:45',
                    ],
                    [
                        'sender' => 'agent',
                        'body' => 'Chào anh Hải, cám ơn anh đã quan tâm đến dịch vụ của chúng tôi! Hiện tại Cửu Long ID có các gói thiết kế website theo yêu cầu, phù hợp với từng nhu cầu và ngân sách của doanh nghiệp ạ.',
                        'minutes_ago' => 12,
                        'time_str' => '09:48',
                    ],
                    [
                        'sender' => 'agent',
                        'body' => 'Anh có thể cho em xin thêm thông tin về lĩnh vực kinh doanh và một số yêu cầu cụ thể để em tư vấn chi tiết hơn ạ?',
                        'minutes_ago' => 10,
                        'time_str' => '09:50',
                    ],
                    [
                        'sender' => 'visitor',
                        'body' => 'Dạ vâng, công ty em kinh doanh trong lĩnh vực bất động sản. Em muốn website có giao diện hiện đại, có tích hợp bản đồ và hệ thống quản lý tin đăng.',
                        'minutes_ago' => 8,
                        'time_str' => '09:52',
                    ],
                ],
            ],
            [
                'name' => 'Trần Thị Mai',
                'phone' => '0918 234 567',
                'email' => 'maitran@gmail.com',
                'city' => 'TP. Hồ Chí Minh',
                'interest' => 'Báo giá thiết kế website theo yêu cầu',
                'channel' => 'Zalo',
                'status' => 'assigned', // Đang xử lý
                'status_label' => 'Đang xử lý',
                'unread' => 2,
                'time_ago' => 15,
                'tags' => ['Khách hàng mới', 'Zalo', 'Thiết kế web'],
                'messages' => [
                    [
                        'sender' => 'visitor',
                        'body' => 'Giá thiết kế website theo yêu cầu là bao nhiêu ạ?',
                        'minutes_ago' => 15,
                        'time_str' => '09:35',
                    ],
                    [
                        'sender' => 'agent',
                        'body' => 'Chào chị Mai, Cửu Long ID đã tiếp nhận yêu cầu. Em sẽ gửi bảng giá chi tiết các gói website qua Zalo cho chị ngay nhé.',
                        'minutes_ago' => 10,
                        'time_str' => '09:40',
                    ],
                ],
            ],
            [
                'name' => 'Lê Minh Tuấn',
                'phone' => '0909 345 678',
                'email' => 'tuanle@gmail.com',
                'city' => 'Đà Nẵng',
                'interest' => 'Lập trình ứng dụng di động & Web-App',
                'channel' => 'Facebook',
                'status' => 'closed', // Đã trả lời / hoàn tất
                'status_label' => 'Đã trả lời',
                'unread' => 1,
                'time_ago' => 28,
                'tags' => ['Lập trình App', 'Facebook', 'Doanh nghiệp'],
                'messages' => [
                    [
                        'sender' => 'visitor',
                        'body' => 'Anh có nhận làm app không? Em cần tư vấn thêm ạ.',
                        'minutes_ago' => 28,
                        'time_str' => '09:20',
                    ],
                    [
                        'sender' => 'agent',
                        'body' => 'Chào anh Tuấn, Cửu Long ID chuyên phát triển Web App & Mobile App chuyên nghiệp. Em xin số điện thoại để trao đổi kỹ thuật cùng anh nhé.',
                        'minutes_ago' => 20,
                        'time_str' => '09:28',
                    ],
                ],
            ],
            [
                'name' => 'Phạm Thị Hương',
                'phone' => '0977 456 789',
                'email' => 'huongpham@gmail.com',
                'city' => 'Cần Thơ',
                'interest' => 'Gói chăm sóc & bảo trì website doanh nghiệp',
                'channel' => 'Website',
                'status' => 'assigned',
                'status_label' => 'Đang xử lý',
                'unread' => 4,
                'time_ago' => 42,
                'tags' => ['Bảo trì website', 'Website', 'Cần Thơ'],
                'messages' => [
                    [
                        'sender' => 'visitor',
                        'body' => 'Cho em hỏi chi phí bảo trì website như thế nào?',
                        'minutes_ago' => 42,
                        'time_str' => '09:05',
                    ],
                ],
            ],
            [
                'name' => 'Hoàng Đức Anh',
                'phone' => '0988 567 890',
                'email' => 'ducanh@gmail.com',
                'city' => 'Hải Phòng',
                'interest' => 'Kho giao diện mẫu website doanh nghiệp',
                'channel' => 'Zalo',
                'status' => 'waiting_agent',
                'status_label' => 'Chưa trả lời',
                'unread' => 6,
                'time_ago' => 60,
                'tags' => ['Kho giao diện', 'Zalo', 'Bán lẻ'],
                'messages' => [
                    [
                        'sender' => 'visitor',
                        'body' => 'Mình muốn xem demo giao diện website.',
                        'minutes_ago' => 60,
                        'time_str' => '08:45',
                    ],
                ],
            ],
            [
                'name' => 'Ngô Thanh Tùng',
                'phone' => '0933 678 901',
                'email' => 'tungngo@gmail.com',
                'city' => 'Bình Dương',
                'interest' => 'Dịch vụ SEO Google tổng thể & Content',
                'channel' => 'Facebook',
                'status' => 'closed',
                'status_label' => 'Đã trả lời',
                'unread' => 1,
                'time_ago' => 65,
                'tags' => ['SEO Tổng thể', 'Facebook', 'Marketing'],
                'messages' => [
                    [
                        'sender' => 'visitor',
                        'body' => 'Công ty mình có hỗ trợ SEO không ạ?',
                        'minutes_ago' => 65,
                        'time_str' => '08:40',
                    ],
                    [
                        'sender' => 'agent',
                        'body' => 'Chào anh Tùng, Cửu Long ID cung cấp dịch vụ SEO tổng thể Onpage & Offpage chuẩn white-hat cam kết từ khóa lên top bền vững ạ.',
                        'minutes_ago' => 55,
                        'time_str' => '08:50',
                    ],
                ],
            ],
            [
                'name' => 'Đỗ Thu Hà',
                'phone' => '0944 789 012',
                'email' => 'hadothu@gmail.com',
                'city' => 'Đồng Tháp',
                'interest' => 'Thiết kế website doanh nghiệp nhỏ & startup',
                'channel' => 'Website',
                'status' => 'assigned',
                'status_label' => 'Đang xử lý',
                'unread' => 3,
                'time_ago' => 120,
                'tags' => ['Doanh nghiệp nhỏ', 'Website', 'Startup'],
                'messages' => [
                    [
                        'sender' => 'visitor',
                        'body' => 'Tư vấn giúp em gói website phù hợp với doanh nghiệp nhỏ ạ.',
                        'minutes_ago' => 120,
                        'time_str' => '07:45',
                    ],
                ],
            ],
        ];

        foreach ($conversationsData as $item) {
            $visitor = ChatVisitor::updateOrCreate(
                ['phone' => $item['phone']],
                [
                    'visitor_uuid' => (string) Str::uuid(),
                    'name' => $item['name'],
                    'email' => $item['email'],
                    'first_ip' => '127.0.0.1',
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                ]
            );

            $statusEnum = match($item['status']) {
                'assigned' => ChatConversationStatus::Assigned,
                'waiting_agent' => ChatConversationStatus::WaitingAgent,
                'closed' => ChatConversationStatus::Closed,
                default => ChatConversationStatus::Open,
            };

            $conv = ChatConversation::updateOrCreate(
                ['chat_visitor_id' => $visitor->id],
                [
                    'conversation_uuid' => (string) Str::uuid(),
                    'assigned_to_user_id' => $agentId,
                    'status' => $statusEnum,
                    'channel' => ChatConversationChannel::Human,
                    'agent_unread_count' => $item['unread'],
                    'visitor_unread_count' => 0,
                    'last_message_at' => now()->subMinutes($item['time_ago']),
                    'created_at' => now()->subHours(5),
                    'updated_at' => now()->subMinutes($item['time_ago']),
                ]
            );

            // Xóa tin nhắn cũ nếu có và thêm tin nhắn mới
            ChatMessage::where('chat_conversation_id', $conv->id)->delete();

            foreach ($item['messages'] as $m) {
                ChatMessage::create([
                    'message_uuid' => (string) Str::uuid(),
                    'chat_conversation_id' => $conv->id,
                    'sender_type' => $m['sender'] === 'agent' ? ChatMessageSenderType::Agent : ChatMessageSenderType::Visitor,
                    'sender_user_id' => $m['sender'] === 'agent' ? $agentId : null,
                    'message_body' => $m['body'],
                    'status' => ChatMessageStatus::Sent,
                    'created_at' => now()->subMinutes($m['minutes_ago']),
                    'updated_at' => now()->subMinutes($m['minutes_ago']),
                ]);
            }
        }
    }
}
