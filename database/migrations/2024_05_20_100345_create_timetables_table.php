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
        Schema::create('timetables', function (Blueprint $table) {
            $table->id();
            $table->string('department')->default('CS');
            $table->string('level')->default('1.1');
            $table->string('course_code');
            $table->string('venue');
            $table->string('time');
            $table->string('day');
            $table->integer('duration');
            $table->string('lecturer');
            $table->string('isCampusWide')->default('Off');
            $table->string('isRepeated')->default('Off');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timetables');
    }
};
