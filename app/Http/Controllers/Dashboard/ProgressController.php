<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Mark;
use App\Models\Student;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @throws \JsonException
     */
    public function getData(){
        $general = [];
        $chart = [];

        $userId = auth()->user()->id;
        $student = Student::where('user_id', $userId)->first();
        if ($student) {
            $group = Group::where('id', $student->group_id)->first();

            for ($i = 1; $i < 9; $i++) {
                $marks = Mark::where('student_id', $student->id)->where('semester', $i)->get();
                $marksArray = $marks->toArray();
                $sum = array_sum(array_column($marksArray, 'mark'));
                $count = count($marksArray);
                $average = ($count > 0) ? round($sum / $count, 1) : 0;
                $chart[] = $average;
            }

            $sum = array_sum($chart);
            $count = count($chart);
            $average = ($count > 0) ? round($sum / $count, 1) : 0;

            $general['fullname'] = implode(' ', [$student->lastname, $student->firstname, $student->middlename]);
            $general['group'] = $group->name;
            $general['average'] = $average;
            $img = $student->image;
        }

        $chart=json_encode($chart, JSON_THROW_ON_ERROR);

        return view('cards.progress', [
            'general' => $general,
            'img' => $img,
            'chart' => $chart
        ]);
    }

}
