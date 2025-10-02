<?php

use GuzzleHttp\Promise\Create;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(
            'books',
            function (Blueprint $table) {
             $table->id()->primary();
             $table->string('name');
             $table->string('type')->nullable();
             $table->string('file_path');
             $table->timestamps();
             $table->foreignId('parent_id')->nullable()->references('id')->on('books')->onDelete('cascade');

            }
        );
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
