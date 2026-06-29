<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('books', function (Blueprint $table) {

        $table->enum('access_type', [
            'free',
            'vip',
            'paid'
        ])->default('free')->after('status');

        $table->decimal('price',10,0)
              ->default(0)
              ->after('access_type');

    });
}
};
