<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $threads = DB::table('threads')->orderBy('updated_at', 'desc')->get()->toArray();
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
        return view('home', ['data' => $data]);
    }
}
