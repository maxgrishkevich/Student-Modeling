<?php

namespace App\Http\Controllers\Admin\Tables;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UniversityEditController extends Controller
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
            $data = University::select('id', 'name')->where('id', $id)->first()->toArray();
            return view('admin.edit.university', ['university' => $data]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Сталася помилка при завантаженні даних');
        }
    }

    /**
     * Save changes to universities table
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $university = University::find($id);
        if (!$university) {
            return redirect()->back()->with('error', 'Університет не знайдено');
        }
        $university->name = $request->input('university');
        $university->save();
        return redirect()->back()->with('success', 'Зміни збережено успішно');
    }

    /**
     * Delete item from universities table
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy ($id): RedirectResponse
    {
        try {
            $university = University::findOrFail($id);
            $university->delete();
            return redirect()->back()->with('success', 'Університет успішно видалено');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Сталася помилка при видаленні університету');
        }
    }

    /**
     * Render and provides add template
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function add()
    {
        try {
            return view('admin.add.university');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Сталася помилка при завантаженні даних');
        }
    }

    /**
     * Save changes to groups table by adding new instance
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function save(Request $request): RedirectResponse
    {
        $university = new University();
        $university->name = $request->input('university');
        $university->save();
        return redirect()->back()->with('success', 'Зміни збережено успішно');
    }
}
