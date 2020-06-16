<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use App\Thread;
use App\Tag;
use App\ThreadTag;
use App\Group;

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
            $messageCount = DB::table('thread_messages')->where('thread_id', $thread['id'])->count();
            $groupName = Group::where('id', $thread['group_id'])->first()->name;
            $startAt = new Carbon($thread['start_at']);
            $updateAt = new Carbon($thread['updated_at']);
            $diffMinites = $startAt->diffInSeconds($updateAt) / 60;
            $wave = round($messageCount / max(1, $diffMinites) * 60, 2);
            $threadData = [
                'id' => $thread['id'],
                'title' => $thread['title'],
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
        $threadCount = Thread::orderBy('updated_at', 'desc')->count();
        $pageCount = range(1, (int)(($threadCount + 19) / 20));
        return view('home', ['pageCount' => $pageCount]);
    }

    public function searchThread(Request $request)
    {    
        $title = (string)$request->input('title');
        $tag = (string)$request->input('tag');
        $paramStartFrom = $request->input('startDateStart');
        $startDateFrom = $paramStartFrom != null ? new Carbon($paramStartFrom) : null;
        $paramStartTo = $request->input('startDateEnd');
        $startDateTo = $paramStartTo != null ? new Carbon($paramStartTo) : null;
        $paramEndFrom = $request->input('endDateStart');
        $endDateFrom = $paramEndFrom != null ? new Carbon($paramEndFrom) : null;
        $paramEndTo = $request->input('startDateEnd');
        $endDateTo = $paramEndTo != null ? new Carbon($paramEndTo) : null;

        $threads = Thread::searchThread($startDateFrom, $startDateTo, $endDateFrom, $endDateTo, $title)
                            ->orderBy('id')->get();

        $responseThreads = [];
        $isExistTag = false;
        if(!empty($tag)){

            $isExistTag = true;
            $tag = Tag::where('name', '=', $tag)->first();
            if(!empty($tag)){

                $threadIdByTags = ThreadTag::where('tag_id', '=', $tag->id)->orderBy('thread_id')->get()->pluck('thread_id');
                $threadIdByTagMap = [];
                foreach($threadIdByTags as $threadIdByTag){
                    $threadIdByTagMap[$threadIdByTag] = true;
                }
        
                foreach($threads as $thread){
                    if(isset($threadIdByTagMap[$thread->id])){
                        $responseThreads[] = $thread;
                    }
                }
            }
        } 
        if(!$isExistTag){
            $responseThreads = $threads->toArray();
        }
        $data = self::organizeThreadData($responseThreads);  
        return json_encode($data);
    }
}
