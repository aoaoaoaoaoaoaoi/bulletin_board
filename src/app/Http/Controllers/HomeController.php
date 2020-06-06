<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use App\Thread;
use App\Tag;
use App\ThreadTag;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function  organizeThreadData(array $threads) : array
    {
        $data = [];
        foreach($threads as $thread){
            $messageCount = DB::table('thread_messages')->where('thread_id', $thread->id)->count();
            $groupName = DB::table('groups')->where('id', $thread->group_id)->first()->name;
            $startAt = new Carbon($thread->start_at);
            $updateAt = new Carbon($thread->updated_at);
            $diffMinites = $startAt->diffInSeconds($updateAt) / 60;
            $wave = round($messageCount / max(1, $diffMinites) * 60, 2);
            $threadData = [
                'id' => $thread->id,
                'title' => $thread->title,
                'updatedAt' => $updateAt->year . "年" . $updateAt->month . "月" . $updateAt->day . "日",
                'wave' => $wave,
                'groupName' => $groupName,
            ];
            $data[] = $threadData;
        }
        return $data;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $threads = Thread::orderBy('updated_at', 'desc')->get()->toArray();
        $data = self::organizeThreadData($threads);
        return view('home', ['data' => $data]);
    }

    public function searchThread(Request $request)
    {    
        $title = (string)$request->input('title');
        $tag = (string)$request->input('tag');
        $startDateFrom = new Carbon($request->input('startDateStart'));
        $startDateTo = new Carbon($request->input('startDateEnd'));
        $endDateFrom = new Carbon($request->input('endDateStart'));
        $endDateTo = new Carbon($request->input('startDateEnd'));

        $threads = Thread::searchThread($startDateFrom, $startDateTo, $endDateFrom, $endDateTo, $title)
                            ->orderBy('id')->get();

        $responseThreads = [];
        $isExistTag = false;
        if(!empty($tag){

            $isExistTag = true;
            $tag = Tag::where('name', '=', $tag)->first();
            if(!empty($tag)){

                $threadIdByTags = ThreadTag::where('tag_id', '=', $tag->id)->orderBy('thread_id')->get()->pluck('thread_id');
                $threadIdByTagMap = [];
                foreach($threadIdByTags as $threadIdByTag){
                    $threadIdByTagMap[$threadIdByTag] = true;
                }
        
                foreach($threads as $thread){
                    isset($threadIdByTagMap[$thread->id]){
                        $responseThreads[] = $thread;
                    }
                }
            }
        } 
        if(!$isExistTag){
            $responseThreads = $threads->toArray();
        }
        $data = self::organizeThreadData($responseThreads);  
        echo json_encode($data);
    }
}
