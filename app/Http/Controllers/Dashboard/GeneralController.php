<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Models\Faculty;
use App\Models\Group;
use App\Models\Specialty;
use App\Models\Student;
use App\Models\University;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class GeneralController extends Controller
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
     * Provide data for template
     *
     * @return Application|Factory|View
     */
    public function getData(){
        $general = [];
        $edu = [];
        $ex = [];
        $img = '';

        if (!empty(auth()->user()->id)) {
            $userId = auth()->user()->id;
            $student = Student::where('user_id', $userId)->first();
            if ($student) {
                $group = Group::where('id', $student->group_id)->first();
                $specialty = Specialty::where('id', $group->specialty_id)->first();
                $faculty = Faculty::where('id', $specialty->faculty_id)->first();
                $university = University::where('id', $specialty->university_id)->first();
                $experience = Experience::where('user_id', $userId)->first();

                $date = date_create_from_format('Y-m-d', $student->entry_date);
                $entryYear = $date->format('Y');
                $now = Carbon::now();
                $year = $now->year;
                $month = $now->month;
                $course = $year - $entryYear;
                if ($month >= 9) { ++$course; }

                $general['fullname'] = implode(' ', [$student->lastname, $student->firstname, $student->middlename]);
                $general['birth'] = $student->birth;
                $general['sex'] = $student->sex;
                $general['role'] = 'Cтудент';

                $edu['entry_date'] = $student->entry_date;
                $edu['graduation_date'] = $student->graduation_date;
                $edu['educational_degree'] = $student->educational_degree;
                $edu['group'] = $group->name;
                $edu['specialty_code'] = $specialty->code;
                $edu['university'] = $university->name;
                $edu['faculty'] = $faculty->name;
                $edu['course'] = $course;

                $ex['employment_status'] = $experience->employment_status;
                $ex['experience'] = $experience->experience;
                $ex['off_experience'] = $experience->off_experience;
                $ex['field'] = $experience->field;
                $ex['position'] = $experience->position;
                $ex['level'] = $experience->level;
                $ex['eng_level'] = $experience->eng_level;

                $img = $student->image;
            }
        }
        return view('cards.general', [
            'general' => $general,
            'edu' => $edu,
            'ex' => $ex,
            'img' => $img
        ]);
    }
}
