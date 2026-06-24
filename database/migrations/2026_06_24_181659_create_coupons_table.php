<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {

            $table->id();

            $table->string('code')
                ->unique();

            $table->string('name');

            $table->integer('discount_percent')
                ->nullable();

            $table->decimal('discount_amount',10,0)
                ->nullable();

            $table->decimal('min_order_amount',10,0)
                ->default(0);

            $table->integer('usage_limit')
                ->nullable();

            $table->integer('used_count')
                ->default(0);

            $table->timestamp('expired_at')
                ->nullable();

            $table->boolean('active')
                ->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};