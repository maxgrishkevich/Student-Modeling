<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Mark;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class BarChartController extends Controller
{
    public function index(Request $request)
    {
        $result = [];
        $semester = $request->semester;
        $userId = auth()->user()->id;
        $student = Student::where('user_id', $userId)->first();

        $marksBySemester = Mark::select('subject_id', 'mark')->where('student_id', $student->id)
            ->where('semester', $semester)->get();

        foreach ($marksBySemester as $mark) {
            $subjectName = Subject::select('name')->where('id', $mark->subject_id)->first();
            $result[$subjectName->name] = $mark->mark;
        }

        return response()->json($result);
    }
}
