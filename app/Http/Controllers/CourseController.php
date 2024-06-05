<?php

namespace App\Http\Controllers;
use App\Models\Course;


use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Get all courses from the database
        $courses = Course::all();
        return response()->json([
            'courses' => $courses
        ]);
    }

    //Get courses by department
    public function getCoursesByDepartment(string $department)
    {
        //Get all courses by department
        $courses = Course::where('department', $department)->get();
        return response()->json([
            'courses' => $courses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //use 'department','level','year','course_code','course_title','lecturer',duration,'isCampusWide','duration',
       //use try catch and all fields are required
       $course =  $request->validate([
            'department' => 'required',
            'level' => 'required',
            'year' => 'required',
            'course_code' => 'required',
            'course_title' => 'required',
            'lecturer' => 'required',
            'duration' => 'required',
            'isCampusWide' => 'required',
            'duration' => 'required'
        ]);
        try {
            //Check if authenticated user is an admin
            if (auth()->user()->role !== 'admin') {
                return response()->json([
                    'message' => 'You are not authorized to create a course'
                ]);
            }
            //first check if course exists
            $course = Course::where('course_code', $request->course_code)->first();
            if ($course) {
                return response()->json([
                    'message' => 'Course already exists'
                ]);
            }
            //create course
            $course = Course::create($request->all());
            return response()->json([
                'message' => 'Course created successfully',
                'course' => $course
            ]);
            

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Course creation failed',
                'error' => $e->getMessage()
            ]);
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //make sure auth user is an admin
        if (auth()->user()->role !== 'admin') {
            return response()->json([
                'message' => 'You are not authorized to update a course'
            ]);
        }
        //Find course by id
        $course = Course::find($id);
        if (!$course) {
            return response()->json([
                'message' => 'Course not found'
            ]);
        }
        //Update course
        $course->update($request->all());
        return response()->json([
            'message' => 'Course updated successfully',
            'course' => $course
        ]);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //Make sure auth user is an admin
        if (auth()->user()->role !== 'admin') {
            return response()->json([
                'message' => 'You are not authorized to delete a course'
            ]);
        }
        //Find course by id
        $course = Course::find($id);
        if (!$course) {
            return response()->json([
                'message' => 'Course not found'
            ]);
        }
        //Delete course
        $course->delete();
        return response()->json([
            'message' => 'Course deleted successfully'
        ]);
    }

    //Search for a course by course code
    public function search(string $course_code)
    {
        //Search for a course by course code. use try catch
        try {
            $course = Course::where('course_code', $course_code)->first();
            if (!$course) {
                return response()->json([
                    'message' => 'Course not found'
                ]);
            }
            return response()->json([
                'course' => $course
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Course search failed',
                'error' => $e->getMessage()
            ]);
        }
    }
}
