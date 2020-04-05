<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use DB;
use Auth;
use \App\Http\Controllers\TagService;
use App\User;
use App\ThreadMessage;
use Carbon\Carbon;

class ThreadController extends Controller
{
    public function index(Request $request)
    {
        $threadId = $request->input('threadId');
        $thread = DB::table('threads')->where('id','=',$threadId)->first();
        $createdUserId = $thread->created_user_id;
        $createdUser = User::where('id','=',$createdUserId)->first();
        $tags = DB::table('thread_tags')->where('thread_id','=',$threadId)->get()->pluck('tag_id');
        $tagName=[];
        foreach($tags as $tag){
            $tagName[]=$tag->name;
        }
        $data=[
            'title' => $thread->title,
            'createdUser' => $createdUser->name,
            'overview' => $thread->overview,
            'tags' => $tagName,
            'endAt' => $thread->end_at, 
            'threadId' => $threadId,  
        ];
        return view('thread_index', ['data' => $data]);
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        $threadId = $request->input('threadId');
        $message = $request->input('message');
        
        //TODO:ロック必要
        $currentLastMessage = ThreadMessage::where('thread_id','=',$threadId)->orderBy('thread_order','desc')->first();

        ThreadMessage::insert([
            'thread_id' => $threadId,
            'thread_order' => $currentLastMessage['thread_order']+1,
            'user_id' => $user->id,
            'message' => $message,
            'posted_time' => Carbon::now(),
        ]);
    }
}
