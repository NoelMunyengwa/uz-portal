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
            $table->string('level');
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
                
                'department' => 'Business Studies and Economics',
                'level' => '4.2',
                'year' => '2024',
                'course_code' => 'POP 999',
                'course_title' => 'Introduction to Business Studies',
                'lecturer' => 'Mr Gonzo',
                'duration' => '1',
                'isCampusWide' => 'On',
                'isRepeated' => 'Off',
            ],
            [
                'department' => 'Computer Science',
                'level' => '4.2',
                'year' => '2024',
                'course_code' => 'CSC 102',
                'course_title' => 'Introduction to Programming',
                'lecturer' => 'Dr. Jane Doe',
                'duration' => '2',
                'isCampusWide' => 'Off',
                'isRepeated' => 'Off',
            ],
            [
                'department' => 'Computer Science',
                'level' => '4.2',
                'year' => '2024',
                'course_code' => 'CSC 103',
                'course_title' => 'Introduction to Web Development',
                'lecturer' => 'Dr. John Doe',
                'duration' => '1',
                'isCampusWide' => 'Off',
                'isRepeated' => 'Off',
            ],
            [
                'department' => 'Computer Science',
                'level' => '4.2',
                'year' => '2024',
                'course_code' => 'CSC 104',
                'course_title' => ' Database Management',
                'lecturer' => 'Miss Mhlanga',
                'duration' => '2',
                'isCampusWide' => 'Off',
                'isRepeated' => 'Off',
            ],
            
            [
                'department' => 'Computer Science',
                'level' => '4.2',
                'year' => '2024',
                'course_code' => 'HCT 404',
                'course_title' => ' Networking',
                'lecturer' => 'Miss Jowa',
                'duration' => '2',
                'isCampusWide' => 'Off',
                'isRepeated' => 'Off',
            ],
            [
                'department' => 'Computer Science',
                'level' => '4.2',
                'year' => '2024',
                'course_code' => 'CSC 106',
                'course_title' => 'Introduction to Cyber Security',
                'lecturer' => 'Miss Jowa',
                'duration' => '1',
                'isCampusWide' => 'Off',
                'isRepeated' => 'Off',
            ],
            [
                'department' => 'Computer Science',
                'level' => '4.2',
                'year' => '2024',
                'course_code' => 'CSC 107',
                'course_title' => 'Introduction to Artificial Intelligence',
                'lecturer' => 'Mr Kavu',
                'duration' => '2',
                'isCampusWide' => 'Off',
                'isRepeated' => 'Off',
            ],
            [
                'department' => 'Computer Science',
                'level' => '2.2',
                'year' => '2024',
                'course_code' => 'CSC 108',
                'course_title' => ' Data Science',
                'lecturer' => 'Miss Jowa',
                'duration' => '2',
                'isCampusWide' => 'Off',
                'isRepeated' => 'Off',
            ],
            [
                'department' => 'Computer Science',
                'level' => '2.2',
                'year' => '2024',
                'course_code' => 'HCT 402',
                'course_title' => 'Software Engineering',
                'lecturer' => 'Mr Gonzo',
                'duration' => '1',
                'isCampusWide' => 'Off',
                'isRepeated' => 'Off',
            ],
            [
                'department' => 'Computer Science',
                'level' => '2.2',
                'year' => '2024',
                'course_code' => 'HCS 222',
                'course_title' => 'JAVA Programming',
                'lecturer' => 'Mr Zanamwe',
                'duration' => '1',
                'isCampusWide' => 'Off',
                'isRepeated' => 'Off',
            ],
            [
                'department' => 'Computer Science',
                'level' => '2.2',
                'year' => '2024',
                'course_code' => 'HCT 112',
                'course_title' => ' Computer Graphics',
                'lecturer' => 'Mr Kavu',
                'duration' => '2',
                'isCampusWide' => 'On',
                'isRepeated' => 'Off',
            ],
            [
                'department' => 'Computer Science',
                'level' => '2.2',
                'year' => '2024',
                'course_code' => 'CSC 203',
                'course_title' => 'Introduction to Operating Systems',
                'lecturer' => 'Dr. Jane Doe',
                'duration' => '1',
                'isCampusWide' => 'Off',
                'isRepeated' => 'Off',
            ],
            [
                'department' => 'Computer Science',
                'level' => '2.2',
                'year' => '2024',
                'course_code' => 'CSC 204',
                'course_title' => ' Internet of Things',
                'lecturer' => 'Miss Mhlanga',
                'duration' => '2',
                'isCampusWide' => 'Off',
                'isRepeated' => 'Off',
            ],
            [
                'department' => 'Computer Science',
                'level' => '2.2',
                'year' => '2024',
                'course_code' => 'HCT 204',
                'course_title' => ' Python Programming',
                'lecturer' => 'Miss Jowa',
                'duration' => '2',
                'isCampusWide' => 'Off',
                'isRepeated' => 'Off',
            ],
            [
                'department' => 'Computer Science',
                'level' => '2.2',
                'year' => '2024',
                'course_code' => 'CSC 206',
                'course_title' => 'Discrete Mathematics',
                'lecturer' => 'Miss Jowa',
                'duration' => '1',
                'isCampusWide' => 'Off',
                'isRepeated' => 'Off',
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
