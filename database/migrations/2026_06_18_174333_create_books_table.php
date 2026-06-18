
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
        Schema::create('books', function (Blueprint $table) {

            $table->id();

            // Thông tin cơ bản
            $table->string('title');
            $table->string('slug')->unique();

            $table->string('author')->nullable();

            // Ảnh bìa
            $table->string('cover')->nullable();

            // File EPUB
            $table->string('epub_file');

            // Mô tả sách
            $table->longText('description')->nullable();

            // Thống kê
            $table->unsignedBigInteger('views')->default(0);
            $table->unsignedBigInteger('favorites')->default(0);

            // Nổi bật
            $table->boolean('featured')->default(false);

            // Trạng thái
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
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};

