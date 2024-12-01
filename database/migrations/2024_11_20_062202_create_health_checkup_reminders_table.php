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
            $table->string('checkup_type');
            $table->date('next_checkup_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('health_checkup_reminders');
    }
};
