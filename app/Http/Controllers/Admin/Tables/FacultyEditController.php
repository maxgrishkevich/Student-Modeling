<?php

namespace App\Http\Controllers\Admin\Tables;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\University;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FacultyEditController extends Controller
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
            $data = Faculty::select('id', 'name', 'fullname', 'university_id')->where('id', $id)->first()->toArray();
            $universities = University::select('id', 'name')->get()->toArray();
            return view('admin.edit.faculty', ['faculty' => $data, 'universities' => $universities]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Сталася помилка при завантаженні даних');
        }
    }

    /**
     * Save changes to faculties table
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
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

    /**
     * Delete row from faculties table
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy ($id): RedirectResponse
    {
        try {
            $faculty = Faculty::findOrFail($id);
            $faculty->delete();
            return redirect()->back()->with('success', 'Факультет успішно видалено');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Сталася помилка при видаленні факультету');
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
            return view('admin.add.faculty', ['universities' => $universities]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Сталася помилка при завантаженні даних');
        }
    }

    /**
     * Save changes to faculties table by adding new instance
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function save(Request $request): RedirectResponse
    {
        try {
            $faculty = new Faculty();
            $faculty->name = $request->input('name');
            $faculty->fullname = $request->input('fullname');
            $faculty->university_id = $request->input('university');
            $faculty->save();
            return redirect()->back()->with('success', 'Зміни збережено успішно');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Сталася помилка при збереженні даних');
        }
    }
}
