<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {

            $table->id();

            // Thông tin cơ bản
            $table->string('title');
            $table->string('slug')->unique();

            $table->string('author')->nullable();

            // Danh mục
            $table->foreignId('category_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            // Ảnh bìa
            $table->string('cover')->nullable();

            // File EPUB
            $table->string('epub_file');

            // Mô tả
            $table->longText('description')->nullable();

            // Metadata
            $table->string('language')->default('vi');
            $table->string('publisher')->nullable();

            // SEO
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();

            // Thống kê
            $table->unsignedBigInteger('views')->default(0);
            $table->unsignedBigInteger('favorites')->default(0);

            // Trạng thái hiển thị
            $table->boolean('featured')->default(false);
            $table->boolean('is_top')->default(false);
            $table->boolean('is_vip')->default(false);

            // Trạng thái xuất bản
            $table->enum('status', [
                'draft',
                'published'
            ])->default('published');

            $table->timestamps();

            // Index
            $table->index('slug');
            $table->index('author');
            $table->index('status');
            $table->index('featured');
            $table->index('is_top');
            $table->index('is_vip');
            $table->index('views');
            $table->index('category_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};