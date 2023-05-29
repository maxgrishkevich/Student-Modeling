<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Group;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index() {
        $groups = Group::select('id', 'name')->get()->toArray();
        return view('auth.register_application', ['groups' => $groups]);
    }

    public function save(Request $request) {
        try {
            $file = $request->file('photocard');
            $destinationPath = 'public/img/students';
            $storedFileName = $file->store($destinationPath);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Сталася помилка при завантаженні зображення');
        }

//        try {
            $application = new Application();
            $application->image = basename($storedFileName);
            $application->email = $request->input('email');
            $application->password = Hash::make($request->input('password'));
            $application->fullname = $request->input('fullname');
            $application->birth = $request->input('birth');
            $application->sex = $request->input('sex');
            $application->group_id = $request->input('group');
            $application->entry_date = $request->input('entry_date');
            $application->graduation_date = $request->input('graduation_date');
            $application->educational_degree = $request->input('educational_degree');
            $application->employment_status = $request->input('employment_status');
            $application->experience = $request->input('experience');
            $application->off_experience = $request->input('off_experience');
            $application->field = $request->input('field');
            $application->position = $request->input('position');
            $application->level = $request->input('level');
            $application->eng_level = $request->input('eng_level');
            $application->save();
//        } catch (Exception $e) {
//            return redirect()->back()->with('error', 'Сталася помилка збереження даних');
//        }
        return redirect()->back()->with('success', 'Заявку на реєстрацію успішно подано');
    }
}
