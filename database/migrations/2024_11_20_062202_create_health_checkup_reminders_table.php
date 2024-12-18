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
        Schema::create('health_checkup_reminders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
            $table->timestamp('checkup_time')->useCurrent();
            $table->string('checkup_name')->nullable();
            $table->integer('checkup_year')->nullable();
            $table->integer('checkup_month')->nullable();
            $table->integer('checkup_date')->nullable();
            $table->integer('checkup_hour')->nullable();
            $table->integer('checkup_minute')->nullable();
            $table->string('checkup_note')->nullable();
            $table->integer('toggle_value')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('health_checkup_reminders');
    }
};
