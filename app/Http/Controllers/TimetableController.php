<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timetable;
use Illuminate\Support\Facades\Http;

use Illuminate\Validation\Rule;


class TimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Get all timetables. use try catch and return a json response
        try {
            $timetables = Timetable::all();
            return response()->json([
                'timetables' => $timetables
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    //Get all timetables by department. use try catch and return a json response
    public function getTimetablesByDepartment(string $department)
    {
        try {
            $timetables = Timetable::where('department', $department)->get();
            return response()->json([
                'timetables' => $timetables
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    //Generate timetable
    public function generateTimetable(Request $request)
    {
        
        try {
            $data = $request->validate([
                'courses' => 'required|array',
                'courses.*' => 'required|array',
                // 'courses.*.id' => 'required|integer',
                'courses.*.departments' => 'required|string',
                'courses.*.levels' => 'required|string',
                'courses.*.year' => 'required|string',
                'courses.*.courses' => 'required|string',
                'courses.*.course_title' => 'required|string',
                'courses.*.lecturers' => 'required|string',
                'courses.*.durations' => 'required|string',
                // 'courses.*.isCampusWide' => 'required|string',
                // 'courses.*.isRepeated' => 'required|string',
            ]);
    
            $extractedCourses = [];
            foreach ($data['courses'] as $course) {
                $extractedCourses[] = [
                    // 'id' => $course['id'],
                    'departments' => $course['departments'],
                    'levels' => $course['levels'],
                    'year' => $course['year'],
                    'courses' => $course['courses'], // Assuming this is the actual course code
                    'course_title' => $course['course_title'],
                    'lecturers' => $course['lecturers'],
                    'durations' => $course['durations'],
                    // 'isCampusWide' => $course['isCampusWide'],
                    // 'isRepeated' => $course['isRepeated'],
                ];
            }
    
            $data= $extractedCourses;
    
            $response = $this->sendToAPI($data);
    
            if ($response->successful()) {
                return response()->json([
                    'message' => 'Timetable created successfully!',
                ]);
            } else {
                return response()->json([
                    'message' => 'Something went wrong!',
                ], $response->status());
            }
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

        
    }
    private function sendToAPI(array $data)
        {
            $url = env('LOCAL_ANT_COLONY_URL'); // Get URL from .env file
            $headers = [
                'Content-Type' => 'application/json',
            ];
    
            return Http::withHeaders($headers)->post($url, json_encode($data));
        }
}
