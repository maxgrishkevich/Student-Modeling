<?php

namespace App\Http\Controllers\Admin\Tables;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\University;
use Illuminate\Http\Request;

class FacultyEditController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index($id) {
        try {
            $data = Faculty::select('id', 'name', 'fullname', 'university_id')->where('id', $id)->first()->toArray();
            $universities = University::select('id', 'name')->get()->toArray();

            return view('admin.edit.faculty', ['faculty' => $data, 'universities' => $universities]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Сталася помилка при завантаженні даних');
        }
    }

    public function update(Request $request, $id) {
        $faculty = Faculty::find($id);
        if (!$faculty) {
            return redirect()->back()->with('error', 'Факультет не знайдено');
        }
        $faculty->name = $request->input('name');
        $faculty->fullname = $request->input('fullname');
        $faculty->university_id = $request->input('university');
        $faculty->save();
        return redirect()->back()->with('success', 'Зміни збережено успішно');
    }

    public function destroy ($id) {
        try {
            $faculty = Faculty::findOrFail($id);
            $faculty->delete();
            return redirect()->back()->with('success', 'Факультет успішно видалено');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Сталася помилка при видаленні факультету');
        }
    }

    public function add(){
        try{
            $universities = University::select('id', 'name')->get()->toArray();
            return view('admin.add.faculty', ['universities' => $universities]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Сталася помилка при завантаженні даних');
        }
    }

    public function save(Request $request) {
        try {
            $faculty = new Faculty();
            $faculty->name = $request->input('name');
            $faculty->fullname = $request->input('fullname');
            $faculty->university_id = $request->input('university');
            $faculty->save();
            return redirect()->back()->with('success', 'Зміни збережено успішно');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Сталася помилка при збереженні даних');
        }
    }
}
