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
        Schema::create('meal_reminders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->timestamp('meal_time')->useCurrent();
            $table->timestamps();
            $table->string('meal_name')->nullable();
            $table->integer('meal_hour')->nullable();
            $table->integer('meal_minute')->nullable();
            $table->integer('meal_frequency')->nullable();
            $table->integer('toggle_value')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('meal_reminders');
    }
};
