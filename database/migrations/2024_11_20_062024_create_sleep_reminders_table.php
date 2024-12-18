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
        Schema::create('sleep_reminders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();   
            $table->timestamp('sleep_time')->useCurrent();
            $table->string('sleep_name')->nullable();
            $table->integer('sleep_hour')->nullable();
            $table->integer('sleep_minute')->nullable();
            $table->integer('wake_hour')->nullable();
            $table->integer('wake_minute')->nullable();
            $table->integer('sleep_frequency')->nullable();
            $table->integer('toggle_value')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sleep_reminders');
    }
};
