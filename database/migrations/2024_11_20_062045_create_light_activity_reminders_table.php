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
        Schema::create('light_activity_reminders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
            $table->timestamp('activity_time')->useCurrent();
            $table->string('activity_name')->nullable();
            $table->integer('activity_hour')->nullable();
            $table->integer('activity_minute')->nullable();
            $table->integer('activity_frequency')->nullable();
            $table->integer('toggle_value')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('light_activity_reminders');
    }
};
