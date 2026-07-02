<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('support_tickets', function (Blueprint $table) {

            // Có gửi email cho user ở lần Admin reply tiếp theo không
            $table->boolean('notify_user')
                  ->default(true)
                  ->after('status');

            // Người gửi tin nhắn cuối cùng
            $table->enum('last_reply_by', [
                'user',
                'admin'
            ])->nullable()
              ->after('notify_user');

            // Thời gian reply cuối
            $table->timestamp('last_reply_at')
                  ->nullable()
                  ->after('last_reply_by');

            // Thời gian đóng ticket
            $table->timestamp('closed_at')
                  ->nullable()
                  ->after('last_reply_at');

        });
    }

    public function down(): void
    {
        Schema::table('support_tickets', function (Blueprint $table) {

            $table->dropColumn([
                'notify_user',
                'last_reply_by',
                'last_reply_at',
                'closed_at'
            ]);

        });
    }
};