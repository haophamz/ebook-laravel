<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('book_purchases', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('book_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('order_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->decimal('price', 10, 0);

            $table->timestamp('purchased_at')->nullable();

            $table->timestamps();

            $table->unique([
                'user_id',
                'book_id'
            ]);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('book_purchases');
    }
};