<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('support_replies', function (Blueprint $table) {

            $table->id();

            $table->foreignId('ticket_id')
                ->constrained('support_tickets')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->boolean('is_admin')->default(false);

            $table->longText('message');

            $table->string('image')->nullable();

            $table->timestamp('seen_at')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_replies');
    }
};