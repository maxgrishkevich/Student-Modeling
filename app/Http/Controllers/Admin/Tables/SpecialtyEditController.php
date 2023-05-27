<?php

namespace App\Http\Controllers\Admin\Tables;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\Specialty;
use App\Models\University;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SpecialtyEditController extends Controller
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
     * @return Application|Factory|View|RedirectResponse
     */
    public function index($id)
    {
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

    /**
     * Save changes to specialties table
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
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

    /**
     * Delete item from faculties table
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy ($id): RedirectResponse
    {
        try {
            $specialty = Specialty::findOrFail($id);
            $specialty->delete();
            return redirect()->back()->with('success', 'Спеціальність успішно видалено');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Сталася помилка при видаленні спеціальністі');
        }
    }

    /**
     * Render and provides add template
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function add()
    {
        try{
            $universities = University::select('id', 'name')->get()->toArray();
            $faculties = Faculty::select('id', 'name')->get()->toArray();
            return view('admin.add.specialty', ['universities' => $universities, 'faculties' => $faculties]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Сталася помилка при завантаженні даних');
        }
    }

    /**
     * Save changes to specialties table by adding new instance
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function save(Request $request): RedirectResponse
    {
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
