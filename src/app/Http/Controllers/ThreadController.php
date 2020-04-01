<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use DB;
use Auth;
use \App\Http\Controllers\TagService;

class ThreadController extends Controller
{
    public function index(Request $request)
    {
        $threadId = $request->input('threadId');
        $thread = DB::table('threads')->where('id','=',$threadId)->first();
        $data=[
            'title' => $thread->title,
            'createdUser' => $thread->name,
            'overview' => $thread->overview,
            'tags' => $thread->tags,
            'endAt' => $thread->endAt,   
        ];
        return view('thread_index', ['data' => $data]);
    }
}
