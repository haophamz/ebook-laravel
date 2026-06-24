<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('vip_plan_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('coupon_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('order_code')
                ->unique();

            $table->decimal('amount',10,0);

            $table->decimal('discount',10,0)
                ->default(0);

            $table->decimal('final_amount',10,0);

            $table->enum('payment_method',[
                'vietqr',
                'momo',
                'zalopay',
                'bank'
            ]);

            $table->enum('status',[
                'pending',
                'paid',
                'cancelled',
                'failed'
            ])->default('pending');

            $table->timestamp('paid_at')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};