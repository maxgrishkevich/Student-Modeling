<?php

namespace App\Http\Controllers\Admin\Tables;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Models\Faculty;
use App\Models\Group;
use App\Models\Specialty;
use App\Models\Student;
use App\Models\University;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentEditController extends Controller
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
     * Render and provide edit template
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function index($id)
    {
        $general = [];
        $edu = [];
        $ex = [];
        $img = '';

        $studentId = $id;
        $student = Student::where('id', $studentId)->first();
        $user = User::where('id', $student->user_id)->first();

        $universities = University::select('name')->get()->toArray();
        $faculties = Faculty::select('name')->get()->toArray();
        $specialties = Specialty::select('code')->get()->toArray();
        $groups = Group::select('name')->get()->toArray();

        if ($student) {
            $group = Group::where('id', $student->group_id)->first();
            $specialty = Specialty::where('id', $group->specialty_id)->first();
            $faculty = Faculty::where('id', $specialty->faculty_id)->first();
            $university = University::where('id', $specialty->university_id)->first();
            $experience = Experience::where('user_id', $user->id)->first();

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

            if ($experience) {
                $ex['employment_status'] = $experience->employment_status;
                $ex['experience'] = $experience->experience;
                $ex['off_experience'] = $experience->off_experience;
                $ex['field'] = $experience->field;
                $ex['position'] = $experience->position;
                $ex['level'] = $experience->level;
                $ex['eng_level'] = $experience->eng_level;
            }

            $img = $student->image;
        }

        return view('admin.edit.student', [
            'id' => $studentId,
            'general' => $general,
            'edu' => $edu,
            'ex' => $ex,
            'img' => $img,
            'universities' => $universities,
            'faculties' => $faculties,
            'specialties' => $specialties,
            'groups' => $groups
        ]);
    }

    /**
     * Save changes to students table
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $student = Student::find($id);
        if (!$student) {
            return redirect()->back()->with('error', 'Студент не знайдений');
        }
        $user = User::find($student->user_id);
//        $group = Group::find($student->group_id);
//        $specialty = Specialty::find($group->specialty_id);
//        $faculty = Faculty::find($specialty->faculty_id);
//        $university = University::find($specialty->university_id);
        $experience = Experience::where('user_id', $user->id)->first();

        $fullname = explode(' ', $request->input('fullname'));
        $student->firstname = $fullname[1];
        $student->lastname = $fullname[0];
        $student->middlename = $fullname[2];
        $student->birth = $request->input('birth');
        $student->sex = $request->input('sex');
        $student->entry_date = $request->input('entry_date');
        $student->graduation_date = $request->input('graduation_date');
        $student->educational_degree = $request->input('educational_degree');
        $gro = Group::where('name', $request->input('group'))->first();
        $student->group_id = $gro->id;

        if (!$experience){
            $experience = new Experience();
        }
        if ($request->input('employment_status') === 'Працевлаштований'){
            $experience->employment_status = 1;
        } else if ($request->input('employment_status') === 'Шукає роботу') {
            $experience->employment_status = 0;
        }
        $experience->experience = $request->input('experience');
        $experience->off_experience = $request->input('off_experience');
        $experience->field = $request->input('field');
        $experience->position = $request->input('position');
        $experience->level = $request->input('level');
        $experience->eng_level = $request->input('eng_level');

        $student->save();
        $experience->save();


        return redirect()->back()->with('success', 'Зміни збережено успішно');
    }

    /**
     * Delete item from faculties table
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy ($id): RedirectResponse
    {
        try {
            $student = Student::findOrFail($id);
            $student->delete();
            return redirect()->back()->with('success', 'Студента успішно видалено');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Сталася помилка при видаленні студента');
        }
    }

    /**
     * Render and provide view template
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function view ($id)
    {
        $general = [];
        $edu = [];
        $ex = [];
        $img = '';

        $student = Student::where('id', $id)->first();

        if ($student) {
            $group = Group::where('id', $student->group_id)->first();
            $specialty = Specialty::where('id', $group->specialty_id)->first();
            $faculty = Faculty::where('id', $specialty->faculty_id)->first();
            $university = University::where('id', $specialty->university_id)->first();
            $experience = Experience::where('user_id', $student->user_id)->first();

            $entryDate = date_create_from_format('Y-m-d', $student->entry_date);
            $entryYear = $entryDate->format('Y');
            $finishDate = date_create_from_format('Y-m-d', $student->graduation_date);
            $finishYear = $finishDate->format('Y');
            $now = Carbon::now();
            $year = $now->year;
            $month = $now->month;
            $course = $year - $entryYear;
            if ($finishYear < $year){
                $course = null;
            } else if ($month >= 9) { ++$course; }

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

            if ($experience) {
                $ex['employment_status'] = $experience->employment_status;
                $ex['experience'] = $experience->experience;
                $ex['off_experience'] = $experience->off_experience;
                $ex['field'] = $experience->field;
                $ex['position'] = $experience->position;
                $ex['level'] = $experience->level;
                $ex['eng_level'] = $experience->eng_level;
            }
            $img = $student->image;
        }

        return view('admin.view.student', [
            'general' => $general,
            'edu' => $edu,
            'ex' => $ex,
            'img' => $img
        ]);
    }

    /**
     * Save changes to groups table by adding new instance
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function save (Request $request): RedirectResponse
    {
        try {
            $file = $request->file('image');
            $destinationPath = 'public/img/students';
            $filename = $file->getClientOriginalName();
            $file->storeAs($destinationPath, $filename);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Сталася помилка при завантаженні зображення');
        }
        $ex = 0;
        if ($request->input('employment_status') === 'Працевлаштований'){
            $ex = 1;
        }
        $fullname = explode(' ', $request->input('fullname'));
        $group = Group::where('name', $request->input('group'))->first();
        try {
            $user = new User();
            $user->name = $request->input('nickname');
            $user->email = $request->input('email');
            $user->email_verified_at = now();
            $user->password = Hash::make($request->input('password'));
            $user->remember_token = Str::random(10);

            $user->save();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Сталася помилка при створенні користувача');
        }
        try {
            $experience = new Experience();
            $experience->user_id = $user->id;
            $experience->employment_status = $ex;
            $experience->experience = $request->input('experience');
            $experience->off_experience = $request->input('off_experience');
            $experience->field = $request->input('field');
            $experience->position = $request->input('position');
            $experience->level = $request->input('level');
            $experience->eng_level = $request->input('eng_level');
            $experience->save();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Сталася помилка при створенні даних досвіду');
        }
        try {
            $student = new Student();
            $student->user_id = $user->id;
            $student->group_id = $group->id;
            $student->firstname = $fullname[1];
            $student->middlename = $fullname[2];
            $student->lastname = $fullname[0];
            $student->image = $filename;
            $student->birth = $request->input('birth');
            $student->sex = $request->input('sex');
            $student->entry_date = $request->input('entry_date');
            $student->graduation_date = $request->input('graduation_date');
            $student->educational_degree = $request->input('educational_degree');
            $student->save();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Сталася помилка при створенні студента');
        }
        return redirect()->back()->with('success', 'Зміни збережено успішно');
    }

    /**
     * Render and provides add template
     *
     * @return Application|Factory|View
     */
    public function add(){
        $groups = Group::select('name')->get()->toArray();
        return view('admin.add.student', ['groups'=>$groups]);
    }
}
