<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('thumbnail')->nullable(); // Menambahkan kolom untuk thumbnail
            $table->string('image_url')->nullable(); // Menambahkan kolom untuk image_url
            $table->text('content');
            $table->foreignId('interest_id')->nullable()->constrained()->onDelete('cascade');
            $table->boolean('is_general')->default(false); // Menambahkan kolom untuk is_general
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
