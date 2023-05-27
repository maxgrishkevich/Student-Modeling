<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Faculty;
use App\Models\Group;
use App\Models\Specialty;
use App\Models\Student;
use App\Models\University;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * Require authentication before rendering
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Provide admin.dashboard template
     *
     * @return Application|Factory|View
     */
    public function index() {
        $counts = [
            'university_counter' => University::count(),
            'specialty_counter' => Specialty::count(),
            'student_counter' => Student::count(),
            'admin_counter' => Admin::count(),
        ];

        $studentsTable = [];
        $students = Student::select('firstname', 'middlename', 'lastname', 'group_id', 'image')->take(4)->get();
        foreach ($students as $student) {
            $group = Group::select('name', 'specialty_id')->where('id', $student->group_id)->first();
            $specialty = Specialty::select('code', 'faculty_id', 'university_id')->where('id', $group->specialty_id)->first();
            $faculty = Faculty::select('name')->where('id', $specialty->faculty_id)->first();
            $university = University::select('name')->where('id', $specialty->university_id)->first();
            $newEl = [
                'img' => $student->image,
                'fullname' => implode(' ', [$student->lastname, $student->firstname, $student->middlename]),
                'university' => $university->name,
                'faculty' => $faculty->name,
                'specialty' => $specialty->code
            ];
            $studentsTable[] = $newEl;
        }

        $specialtyTable = [];
        $specialties = Specialty::select('university_id', 'faculty_id', 'code', 'name')->take(4)->get();
        foreach ($specialties as $specialty) {
            $faculty = Faculty::select('name')->where('id', $specialty->faculty_id)->first();
            $university = University::select('name')->where('id', $specialty->university_id)->first();
            $newEl = [
                'code' => $specialty->code,
                'name' => $specialty->name,
                'university' => $university->name,
                'faculty' => $faculty->name,
            ];
            $specialtyTable[] = $newEl;
        }

        return view('admin.dashboard', [
            'counts' => $counts,
            'student_rows' => $studentsTable,
            'specialty_rows' => $specialtyTable
        ]);
    }
}
