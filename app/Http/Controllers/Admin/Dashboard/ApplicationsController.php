<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Experience;
use App\Models\Faculty;
use App\Models\Group;
use App\Models\Specialty;
use App\Models\Student;
use App\Models\University;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class ApplicationsController extends Controller
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
     * Render and provide template applications table
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|RedirectResponse
     */
    public function index()
    {
        $applicationsTable = [];
        $apps = Application::all();
        foreach ($apps as $app) {
            $group = Group::select('name', 'specialty_id')->where('id', $app->group_id)->first();
            $specialty = Specialty::select('code', 'name', 'faculty_id', 'university_id')->where('id', $group->specialty_id)->first();
            $faculty = Faculty::select('name')->where('id', $specialty->faculty_id)->first();
            $university = University::select('name')->where('id', $specialty->university_id)->first();
            $newEl = [
                'id' => $app->id,
                'img' => $app->image,
                'fullname' => $app->fullname,
                'university' => $university->name,
                'faculty' => $faculty->name,
                'specialty' => $specialty->code,
                'specialty_full' => $specialty->name,
                'email' => $app->email
            ];
            $applicationsTable[] = $newEl;
        }
        if (!$applicationsTable) {
            return redirect()->back()->with('info', 'Наразі немає нових заявок!)');
        }
        return view('admin.pages.applications', ['apps' => $applicationsTable]);
    }

    /**
     * Render and provide view template
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|RedirectResponse
     */
    public function view($id)
    {
        $general = [];
        $edu = [];
        $ex = [];

        $app = Application::where('id', $id)->first();

        if ($app) {
            $group = Group::where('id', $app->group_id)->first();
            $specialty = Specialty::where('id', $group->specialty_id)->first();
            $faculty = Faculty::where('id', $specialty->faculty_id)->first();
            $university = University::where('id', $specialty->university_id)->first();

            $entryDate = date_create_from_format('Y-m-d', $app->entry_date);
            $entryYear = $entryDate->format('Y');
            $finishDate = date_create_from_format('Y-m-d', $app->graduation_date);
            $finishYear = $finishDate->format('Y');
            $now = Carbon::now();
            $year = $now->year;
            $month = $now->month;
            $course = $year - $entryYear;
            if ($finishYear < $year){
                $course = null;
            } else if ($month >= 9) { ++$course; }

            $general['fullname'] = $app->fullname;
            $general['birth'] = $app->birth;
            $general['sex'] = $app->sex;
            $general['role'] = 'Cтудент';

            $edu['entry_date'] = $app->entry_date;
            $edu['graduation_date'] = $app->graduation_date;
            $edu['educational_degree'] = $app->educational_degree;
            $edu['group'] = $group->name;
            $edu['specialty_code'] = $specialty->code;
            $edu['university'] = $university->name;
            $edu['faculty'] = $faculty->name;
            $edu['course'] = $course;

            $ex['employment_status'] = $app->employment_status;
            $ex['experience'] = $app->experience;
            $ex['off_experience'] = $app->off_experience;
            $ex['field'] = $app->field;
            $ex['position'] = $app->position;
            $ex['level'] = $app->level;
            $ex['eng_level'] = $app->eng_level;

            $img = $app->image;
        } else {
            return redirect()->back()->with('error', 'Заявку не знайдено!');
        }

        return view('admin.view.student', [
            'general' => $general,
            'edu' => $edu,
            'ex' => $ex,
            'img' => $img
        ]);
    }

    /**
     * Add new student model
     *
     * @param $id
     * @return RedirectResponse
     */
    public function accept($id): RedirectResponse
    {
        $app = Application::findOrFail($id);
        $fullname = explode(' ', $app->fullname);
        try {
            $user = new User();
            $user->name = $fullname[1];
            $user->email = $app->email;
            $user->email_verified_at = now();
            $user->password = $app->password;
            $user->remember_token = Str::random(10);

            $user->save();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Сталася помилка при створенні користувача');
        }
        try {
            $experience = new Experience();
            $experience->user_id = $user->id;
            $experience->employment_status = $app->employment_status;
            $experience->experience = $app->experience;
            $experience->off_experience = $app->off_experience;
            $experience->field = $app->field;
            $experience->position = $app->position;
            $experience->level = $app->level;
            $experience->eng_level = $app->eng_level;
            $experience->save();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Сталася помилка при створенні даних досвіду');
        }
        try {
            $student = new Student();
            $student->user_id = $user->id;
            $student->group_id = $app->group_id;
            $student->firstname = $fullname[1];
            $student->middlename = $fullname[2];
            $student->lastname = $fullname[0];
            $student->image = $app->image;
            $student->birth = $app->birth;
            $student->sex = $app->sex;
            $student->entry_date = $app->entry_date;
            $student->graduation_date = $app->graduation_date;
            $student->educational_degree = $app->educational_degree;
            $student->save();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Сталася помилка при створенні студента');
        }
        $this->reject($id);
        return redirect()->back()->with('success', 'Зміни збережено успішно');
    }

    /**
     * Delete viewed application
     *
     * @param $id
     * @return RedirectResponse
     */
    public function reject($id): RedirectResponse
    {
        try {
            $app = Application::findOrFail($id);
            $app->delete();
            return redirect()->back()->with('success', 'Заявку відхилено та успішно видалено');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Сталася помилка при відхиленні заявки');
        }
    }
}
