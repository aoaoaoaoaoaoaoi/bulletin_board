<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use DB;
use Auth;
use \App\Http\Controllers\TagService;
use App\User;

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
        ];
        return view('thread_index', ['data' => $data]);
    }
}
