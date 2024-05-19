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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string("reg_number")->required();
            $table->string("surname") ->required();
            $table->string("first_name") ->required();
            $table->string("faculty")->required();
            $table->string("programme_code")->required();
            $table->string("programme_name")->required();
            $table->string("mobile");
            $table->string("email");
            $table->string("registration_status");
            $table->string("programme_start_year");
            $table->string("current_year");
            $table->string("id_Number");
            $table->string("initial");
            $table->string("dob");
            $table->string("year_of_tudy");
            $table->string("semester");
            $table->string("address");
            $table->string("sponsor");
            $table->string("barcode");
            $table->string("years_till_time_out");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
