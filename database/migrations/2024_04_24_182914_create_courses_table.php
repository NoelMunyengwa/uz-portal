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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('department');
            $table->string('semester');
            $table->string('year');
            $table->string('course_code');
            $table->string('course_title');
            $table->string('lecturer');
            // $table->string('day');
            $table->string('duration');
            // $table->string('venue'); 
            $table->string('isCampusWide')->default('Off');
            $table->string('isRepeated')->default('Off');   
            $table->timestamps();
        });

        //default courses
        DB::table('courses')->insert([
            [
                'department' => 'Computer Science',
                'semester' => '1',
                'year' => '2024',
                'course_code' => 'CSC 101',
                'course_title' => 'Introduction to Computer Science',
                'lecturer' => 'Dr. John Doe',
                'duration' => '1',
            ],
            [
                'department' => 'Computer Science',
                'semester' => '1',
                'year' => '2024',
                'course_code' => 'CSC 102',
                'course_title' => 'Introduction to Programming',
                'lecturer' => 'Dr. Jane Doe',
                'duration' => '2',
            ],
            [
                'department' => 'Computer Science',
                'semester' => '1',
                'year' => '2024',
                'course_code' => 'CSC 103',
                'course_title' => 'Introduction to Web Development',
                'lecturer' => 'Dr. John Doe',
                'duration' => '1',
            ],
            [
                'department' => 'Computer Science',
                'semester' => '1',
                'year' => '2024',
                'course_code' => 'CSC 104',
                'course_title' => 'Introduction to Database Management',
                'lecturer' => 'Dr. Jane Doe',
                'duration' => '2',
            ],
            [
                'department' => 'Computer Science',
                'semester' => '1',
                'year' => '2024',
                'course_code' => 'CSC 105',
                'course_title' => 'Introduction to Networking',
                'lecturer' => 'Dr. John Doe',
                'duration' => '2',
            ],
            [
                'department' => 'Computer Science',
                'semester' => '1',
                'year' => '2024',
                'course_code' => 'CSC 106',
                'course_title' => 'Introduction to Cyber Security',
                'lecturer' => 'Dr. Jane Doe',
                'duration' => '1',
            ],

        ]);
            
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
