<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Mark;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BarChartController extends Controller
{
    /**
     * Require authentication before rendering
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Process AJAX request
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $result = [];
        $semester = $request->semester;
        if (!empty(auth()->user()->id)) {
            $userId = auth()->user()->id;
            $student = Student::where('user_id', $userId)->first();
            $marksBySemester = Mark::select('subject_id', 'mark')->where('student_id', $student->id)
                ->where('semester', $semester)->get();
            foreach ($marksBySemester as $mark) {
                $subjectName = Subject::select('name')->where('id', $mark->subject_id)->first();
                $result[$subjectName->name] = $mark->mark;
            }
        }
        return response()->json($result);
    }
}
