<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\Group;
use App\Models\Specialty;
use App\Models\University;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class OtherTablesController extends Controller
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
     * Provide admin.pages.other_tables template
     *
     * @return Application|Factory|View
     */
    public function index() {
        $universitiesTable = University::select('id', 'name')->get()->toArray();

        $facultiesTable = [];
        $faculties = Faculty::select('id', 'university_id', 'name', 'fullname')->get()->toArray();
        foreach ($faculties as $faculty) {
            $uniName = University::select('name')->where('id', $faculty['university_id'])->first();
            $newEl = [
                'id' => $faculty['id'],
                'name' => $faculty['name'],
                'fullname' => $faculty['fullname'],
                'university' => $uniName->name
            ];
            $facultiesTable[] = $newEl;
        }

        $specialtiesTable = [];
        $specialties = Specialty::select('id', 'university_id', 'faculty_id', 'code', 'name')->get()->toArray();
        foreach ($specialties as $specialty) {
            $uniName = University::select('name')->where('id', $specialty['university_id'])->first();
            $facName = Faculty::select('name')->where('id', $specialty['faculty_id'])->first();
            $newEl = [
                'id' => $specialty['id'],
                'code' => $specialty['code'],
                'name' => $specialty['name'],
                'university' => $uniName->name,
                'faculty' => $facName->name
            ];
            $specialtiesTable[] = $newEl;
        }

        $groupsTable = [];
        $groups = Group::select('id', 'name', 'specialty_id')->get()->toArray();
        foreach ($groups as $group) {
            $speCode = Specialty::select('code')->where('id', $group['specialty_id'])->first();
            $newEl = [
                'id' => $group['id'],
                'code' => $speCode->code,
                'name' => $group['name']
            ];
            $groupsTable[] = $newEl;
        }

        return view('admin.pages.other_tables', [
            'universities' => $universitiesTable,
            'faculties' => $facultiesTable,
            'specialties' => $specialtiesTable,
            'groups' => $groupsTable
        ]);
    }
}
