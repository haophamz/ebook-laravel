<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Thêm cột lưu mã nhóm giỏ hàng (cho phép null vì mua lẻ 1 cuốn thì không cần cột này)
            $table->string('cart_group_code')->nullable()->after('order_code');
            
            // Tạo index cho cột này để sau này hệ thống truy vấn (select) danh sách đơn gộp cực nhanh
            $table->index('cart_group_code');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('cart_group_code');
        });
    }
};