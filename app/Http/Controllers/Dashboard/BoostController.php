<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Boost;
use App\Models\Mark;
use App\Models\Student;
use App\Models\Subject;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use GuzzleHttp\Client;
use Carbon\Carbon;
use JsonException;

class BoostController extends Controller
{
    /**
     * Require authentication before rendering
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Provide template with data
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $res = [];
        if (!empty(auth()->user()->id)) {
            $userId = auth()->user()->id;
            $student = Student::where('user_id', $userId)->first();
            $boosts = Boost::where('student_id', $student->id)->where('status', 0)->get()->toArray();
            foreach ($boosts as $boost) {
                $subject = Subject::select('name')->where('id', $boost['subject_id'])->first();
                $boost['subject'] = $subject->name;
                $boost['date'] = Carbon::parse($boost['created_at'])->format('d.m.Y H:i');
                $res[] = $boost;
            }
        }
        return view('cards.boost', [
            'boosts' => $res
        ]);
    }

    /**
     * Generate new boost resources
     *
     * @return RedirectResponse
     * @throws GuzzleException
     */
    public function loadBoost(): RedirectResponse
    {
        try {
            if (!empty(auth()->user()->id)) {
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
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Щось пішло не так(');
        }
        return redirect()->back()->with('success', 'Зміни збережено успішно');
    }

    /**
     * Make API request and return results
     *
     * @param $subject
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     */
    private function apiRequest($subject): array
    {
        $client = new Client();
        $apiKey = 'AIzaSyBZC5HSFJZpAdppFPNItB4GgWTYSCBZ7L4';
        $cx = 'f05f3acd8ffd2473b';
        $query = "$subject :pdf";
        $numResults = 2;
        $url = "https://www.googleapis.com/customsearch/v1?key=$apiKey&cx=$cx&q=$query&num=$numResults";
        $response = $client->get($url);
        $data = json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);
        $links = [];
        foreach ($data['items'] as $item) {
            $links[] = [
                'link' => $item['link'],
                'title' => $item['title']
            ];
        }
        return $links;
    }

    /**
     * Change status of boost
     *
     * @param $id
     * @return RedirectResponse
     */
    public function changeStatus($id): RedirectResponse
    {
        try {
            $boost = Boost::findOrFail($id);
            $boost->status = 1;
            $boost->save();
            return redirect()->back()->with('success');
        } catch (Exception $e) {
            return redirect()->back()->with('error');
        }
    }
}
