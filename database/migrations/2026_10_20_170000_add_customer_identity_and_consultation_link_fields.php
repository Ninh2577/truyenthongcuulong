<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Mở rộng bảng contacts để liên kết với ChatVisitor và lưu nguồn gốc chi tiết
        Schema::table('contacts', function (Blueprint $table) {
            if (!Schema::hasColumn('contacts', 'chat_visitor_id')) {
                $table->foreignId('chat_visitor_id')
                    ->nullable()
                    ->after('id')
                    ->constrained('chat_visitors')
                    ->nullOnDelete();
            }
            if (!Schema::hasColumn('contacts', 'source_url')) {
                $table->text('source_url')->nullable()->after('service_interested');
            }
            if (!Schema::hasColumn('contacts', 'phone_normalized')) {
                $table->string('phone_normalized', 30)->nullable()->index()->after('phone');
            }
            if (!Schema::hasColumn('contacts', 'email_normalized')) {
                $table->string('email_normalized', 150)->nullable()->index()->after('email');
            }
        });

        // 2. Mở rộng bảng chat_visitors để hỗ trợ Customer Identity Resolution và Customer 360
        Schema::table('chat_visitors', function (Blueprint $table) {
            if (!Schema::hasColumn('chat_visitors', 'phone_normalized')) {
                $table->string('phone_normalized', 30)->nullable()->index()->after('phone');
            }
            if (!Schema::hasColumn('chat_visitors', 'email_normalized')) {
                $table->string('email_normalized', 150)->nullable()->index()->after('email');
            }
            if (!Schema::hasColumn('chat_visitors', 'is_identified')) {
                $table->boolean('is_identified')->default(false)->index()->after('user_agent');
            }
            if (!Schema::hasColumn('chat_visitors', 'last_interaction_at')) {
                $table->timestamp('last_interaction_at')->nullable()->index()->after('is_identified');
            }
        });

        // 3. Backfill dữ liệu normalized cho các visitor hiện có (không sửa đổi/xóa dữ liệu gốc)
        DB::table('chat_visitors')
            ->whereNotNull('phone')
            ->where('phone', '!=', '')
            ->chunkById(200, function ($visitors) {
                foreach ($visitors as $v) {
                    $normPhone = preg_replace('/[^0-9]/', '', $v->phone);
                    if (str_starts_with($normPhone, '84') && strlen($normPhone) >= 11) {
                        $normPhone = '0' . substr($normPhone, 2);
                    }
                    $normEmail = $v->email ? strtolower(trim($v->email)) : null;

                    DB::table('chat_visitors')
                        ->where('id', $v->id)
                        ->update([
                            'phone_normalized' => $normPhone ?: null,
                            'email_normalized' => $normEmail,
                            'is_identified' => true,
                            'last_interaction_at' => $v->updated_at ?: $v->created_at,
                        ]);
                }
            });

        // Đánh dấu các visitor có email hợp lệ
        DB::table('chat_visitors')
            ->where('is_identified', false)
            ->whereNotNull('email')
            ->where('email', '!=', '')
            ->update([
                'email_normalized' => DB::raw('LOWER(TRIM(email))'),
                'is_identified' => true,
            ]);

        // Đánh dấu các visitor đã từng có cuộc hội thoại chat
        $visitorIdsWithConv = DB::table('chat_conversations')->pluck('chat_visitor_id')->filter()->unique();
        if ($visitorIdsWithConv->isNotEmpty()) {
            DB::table('chat_visitors')
                ->whereIn('id', $visitorIdsWithConv)
                ->update(['is_identified' => true]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            if (Schema::hasColumn('contacts', 'chat_visitor_id')) {
                $table->dropForeign(['chat_visitor_id']);
                $table->dropColumn('chat_visitor_id');
            }
            if (Schema::hasColumn('contacts', 'source_url')) {
                $table->dropColumn('source_url');
            }
            if (Schema::hasColumn('contacts', 'phone_normalized')) {
                $table->dropColumn('phone_normalized');
            }
            if (Schema::hasColumn('contacts', 'email_normalized')) {
                $table->dropColumn('email_normalized');
            }
        });

        Schema::table('chat_visitors', function (Blueprint $table) {
            if (Schema::hasColumn('chat_visitors', 'phone_normalized')) {
                $table->dropColumn('phone_normalized');
            }
            if (Schema::hasColumn('chat_visitors', 'email_normalized')) {
                $table->dropColumn('email_normalized');
            }
            if (Schema::hasColumn('chat_visitors', 'is_identified')) {
                $table->dropColumn('is_identified');
            }
            if (Schema::hasColumn('chat_visitors', 'last_interaction_at')) {
                $table->dropColumn('last_interaction_at');
            }
        });
    }
};
