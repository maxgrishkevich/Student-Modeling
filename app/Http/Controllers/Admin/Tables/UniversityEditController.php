<?php

namespace App\Http\Controllers\Admin\Tables;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;

class UniversityEditController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index($id) {
        try {
            $data = University::select('id', 'name')->where('id', $id)->first()->toArray();
            return view('admin.edit.university', ['university' => $data]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Сталася помилка при завантаженні даних');
        }
    }

    public function update(Request $request, $id) {
        $university = University::find($id);
        if (!$university) {
            return redirect()->back()->with('error', 'Університет не знайдено');
        }
        $university->name = $request->input('university');
        $university->save();
        return redirect()->back()->with('success', 'Зміни збережено успішно');
    }

    public function destroy ($id) {
        try {
            $university = University::findOrFail($id);
            $university->delete();
            return redirect()->back()->with('success', 'Університет успішно видалено');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Сталася помилка при видаленні університету');
        }
    }

    public function add(){
        try {
            return view('admin.add.university');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Сталася помилка при завантаженні даних');
        }
    }

    public function save(Request $request) {
        $university = new University();
        $university->name = $request->input('university');
        $university->save();
        return redirect()->back()->with('success', 'Зміни збережено успішно');
    }
}
