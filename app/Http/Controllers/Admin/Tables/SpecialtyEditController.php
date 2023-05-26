<?php

namespace App\Http\Controllers\Admin\Tables;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\Specialty;
use App\Models\University;
use Illuminate\Http\Request;

class SpecialtyEditController extends Controller
{
    public function __construct() {
        $this->middleware('auth:admin');
    }

    public function index($id) {
        try {
            $specialty = Specialty::select('id', 'code', 'name', 'university_id', 'faculty_id')->where('id', $id)->first()->toArray();
            $universities = University::select('id', 'name')->get()->toArray();
            $faculties = Faculty::select('id', 'name')->get()->toArray();

            return view('admin.edit.specialty', [
                'specialty' => $specialty,
                'universities' => $universities,
                'faculties' => $faculties
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Сталася помилка при завантаженні даних');
        }
    }

    public function update(Request $request, $id) {
        $specialty = Specialty::find($id);
        if (!$specialty) {
            return redirect()->back()->with('error', 'Спеціальність не знайдено');
        }
        $specialty->code = $request->input('code');
        $specialty->name = $request->input('name');
        $specialty->university_id = $request->input('university');
        $specialty->faculty_id = $request->input('faculty');
        $specialty->save();
        return redirect()->back()->with('success', 'Зміни збережено успішно');
    }

    public function destroy ($id) {
        try {
            $specialty = Specialty::findOrFail($id);
            $specialty->delete();
            return redirect()->back()->with('success', 'Спеціальність успішно видалено');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Сталася помилка при видаленні спеціальністі');
        }
    }

    public function add(){
        try{
            $universities = University::select('id', 'name')->get()->toArray();
            $faculties = Faculty::select('id', 'name')->get()->toArray();
            return view('admin.add.specialty', ['universities' => $universities, 'faculties' => $faculties]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Сталася помилка при завантаженні даних');
        }
    }

    public function save(Request $request) {
        try {
            $specialty = new Specialty();
            $specialty->code = $request->input('code');
            $specialty->name = $request->input('name');
            $specialty->university_id = $request->input('university');
            $specialty->faculty_id = $request->input('faculty');
            $specialty->save();
            return redirect()->back()->with('success', 'Зміни збережено успішно');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Сталася помилка при збереженні даних');
        }
    }
}
