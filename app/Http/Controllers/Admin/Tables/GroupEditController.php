<?php

namespace App\Http\Controllers\Admin\Tables;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\Group;
use App\Models\Specialty;
use App\Models\University;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GroupEditController extends Controller
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
            $data = [];
            $group = Group::where('id', $id)->first();
            $specialty = Specialty::where('id', $group->specialty_id)->first();
            $university = University::where('id', $specialty->university_id)->first();
            $faculty = Faculty::where('id', $specialty->faculty_id)->first();
            $data['id'] = $id;
            $data['name'] = $group->name;
            $data['specialty_row'] = implode(' / ', [
                $specialty->code,
                $university->name,
                $faculty->name
            ]);
            $specData = $this->getSpecData();
            return view('admin.edit.group', [
                'group' => $data,
                'specialties' => $specData
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Сталася помилка при завантаженні даних');
        }
    }

    /**
     * Save changes to groups table
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $group = Group::find($id);
        if (!$group) {
            return redirect()->back()->with('error', 'Групу не знайдено');
        }
        $group->name = $request->input('group');
        $group->specialty_id = $request->input('specialty');
        $group->save();
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
            $group = Group::findOrFail($id);
            $group->delete();
            return redirect()->back()->with('success', 'Групу успішно видалено');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Сталася помилка при видаленні групи');
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
            $specData = $this->getSpecData();
            return view('admin.add.group', ['specialties' => $specData]);
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
        $group = new Group();
        $group->name = $request->input('group');
        $group->specialty_id = $request->input('specialty');
        $group->save();
        return redirect()->back()->with('success', 'Зміни збережено успішно');
    }

    /**
     * Get data of specialities
     *
     * @return array
     */
    private function getSpecData(): array
    {
        $specData = [];
        $specialties = Specialty::select('id', 'code', 'university_id', 'faculty_id')->get()->toArray();
        foreach ($specialties as $special) {
            $uni = University::where('id', $special['university_id'])->first();
            $fac = Faculty::where('id', $special['faculty_id'])->first();
            $specData[] = [
                'specialty_row' => implode(' / ', [
                    $special['code'],
                    $uni->name,
                    $fac->name]),
                'id' => $special['id']
            ];
        }
        return $specData;
    }
}
