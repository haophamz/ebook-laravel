<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vip_plans', function (Blueprint $table) {

            $table->id();

            $table->string('name');

            $table->integer('months');

            $table->decimal('price', 10, 0);

            $table->text('description')
                  ->nullable();

            $table->integer('sort')
                  ->default(0);

            $table->boolean('active')
                  ->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vip_plans');
    }
};