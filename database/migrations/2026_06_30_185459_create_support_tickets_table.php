<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();

            // Nếu user đã đăng nhập thì lưu user_id, khách vãng lai thì null
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            $table->string('email');
            $table->string('title');
            $table->enum('category', [
                'payment',      // Thanh toán & Đơn hàng
                'vip',          // Hội viên VIP
                'ebook',        // Lỗi đọc Ebook
                'account',      // Tài khoản
                'other',        // Khác
            ]);
            $table->text('description');
            $table->string('image_path')->nullable();

            // Trạng thái xử lý ticket
            $table->enum('status', ['pending', 'processing', 'resolved', 'closed'])
                ->default('pending');

            $table->text('admin_note')->nullable(); // ghi chú nội bộ của admin khi xử lý

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_tickets');
    }
};