<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\Group;
use App\Models\Specialty;
use App\Models\Student;
use App\Models\University;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class StudentsController extends Controller
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
     * Provide admin.pages.students template
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $studentsTable = [];
        $students = Student::select('id', 'user_id', 'firstname', 'middlename', 'lastname', 'group_id', 'image')->get();
        foreach ($students as $student) {
            $user = User::select('email')->where('id', $student->user_id)->first();
            $group = Group::select('name', 'specialty_id')->where('id', $student->group_id)->first();
            $specialty = Specialty::select('code', 'name', 'faculty_id', 'university_id')->where('id', $group->specialty_id)->first();
            $faculty = Faculty::select('name')->where('id', $specialty->faculty_id)->first();
            $university = University::select('name')->where('id', $specialty->university_id)->first();
            $newEl = [
                'id' => $student->id,
                'img' => $student->image,
                'fullname' => implode(' ', [$student->lastname, $student->firstname, $student->middlename]),
                'university' => $university->name,
                'faculty' => $faculty->name,
                'specialty' => $specialty->code,
                'specialty_full' => $specialty->name,
                'email' => $user->email
            ];
            $studentsTable[] = $newEl;
        }

        return view('admin.pages.students', [
            'student_rows' => $studentsTable
        ]);
    }
}
