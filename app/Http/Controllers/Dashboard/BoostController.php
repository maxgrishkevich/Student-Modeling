<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Boost;
use App\Models\Mark;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Carbon\Carbon;

class BoostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userId = auth()->user()->id;
        $student = Student::where('user_id', $userId)->first();
        $boosts = Boost::where('student_id', $student->id)->where('status', 0)->get()->toArray();

        $res = [];
        foreach ($boosts as $boost) {
            $subject = Subject::select('name')->where('id', $boost['subject_id'])->first();
            $boost['subject'] = $subject->name;

            $boost['date'] = Carbon::parse($boost['created_at'])->format('d.m.Y H:i');

            $res[] = $boost;
        }

        return view('cards.boost', [
            'boosts' => $res
        ]);
    }

    public function loadBoost() {
        try {
            $userId = auth()->user()->id;
            $student = Student::where('user_id', $userId)->first();

            $marks = Mark::where('student_id', $student->id)->orderBy('mark', 'asc')
                ->whereNotIn('subject_id', function ($query) {
                    $query->select('subject_id')->from('boosts');
                })->take(3)->get();

            if ($marks) {
                foreach ($marks as $mark) {
                    $subject = Subject::where('id', $mark->subject_id)->first();
                    $links = $this->apiRequest($subject->name);
                    foreach ($links as $link) {
                        $boost = new Boost();
                        $boost->student_id = $student->id;
                        $boost->subject_id = $subject->id;
                        $boost->status = 0;
                        $boost->link = $link['link'];
                        $boost->title = $link['title'];
                        $boost->save();
                    }
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Щось пішло не так(');
        }

        return redirect()->back()->with('success', 'Зміни збережено успішно');
    }

    private function apiRequest($subject){
        $client = new Client();

        $apiKey = 'AIzaSyBZC5HSFJZpAdppFPNItB4GgWTYSCBZ7L4';
        $cx = 'f05f3acd8ffd2473b';
        $query = "$subject :pdf";
        $numResults = 2;

        $url = "https://www.googleapis.com/customsearch/v1?key={$apiKey}&cx={$cx}&q={$query}&num={$numResults}";

        $response = $client->get($url);
        $data = json_decode($response->getBody(), true);

        $links = [];
        foreach ($data['items'] as $item) {
            $links[] = [
                'link' => $item['link'],
                'title' => $item['title']
            ];
        }

        return $links;
    }

    public function changeStatus($id){
        try {
            $boost = Boost::findOrFail($id);
            $boost->status = 1;
            $boost->save();
            return redirect()->back()->with('success');
        } catch (\Exception $e) {
            return redirect()->back()->with('error');
        }
    }
}
