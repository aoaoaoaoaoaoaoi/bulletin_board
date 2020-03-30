<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use DB;
use Auth;
use \App\Http\Controllers\TagService;

class MakeThreadController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userJoinGroupIds = DB::table('player_groups')->where('player_id', '=', $user['id'])->get()->pluck('group_id');
        $userJoinGroupInfo = DB::table('groups')->whereIn('id', $userJoinGroupIds)->get();
        $data=[];
        foreach ($userJoinGroupInfo as $groupInfo)
        {
            $groupData=[
                'name' => $groupInfo->name,
                'id' => $groupInfo->id,
            ];
            $data[] = $groupData;
        }
        return view('make_thread_index', ['joinGroup' => $data]);
    }

    public function makeThread(Request $request)
    {
        $user = Auth::user();
        $title = $request->input('title');
        $group = $request->input('group');
        $threadTags = $request->input('usertag');
        $overview = $request->input('threadOverview');
        $threadPriod = $request->input('period');
        $startAt = null;
        $endAt = null;
        if($threadPriod == "specifyPeriod"){
            $threadStartAt = $request->input('startAt');
            $threadEndAt = $request->input('endAt');
        }

        $insertResult = DB::table('threads')->insert([
            'created_user_id' => $user->id,
            'group_id' => $group,
            'title' => $title,
            'overview' => $overview,
            'start_at' => $startAt,
            'end_at' => $endAt,
        ]);

        $tags = TagService::getInstance()->insertTag($threadTags);
        
        foreach($tags as $tag){
            'thread_id' => $insertResult->id,
            'tag_id' => $tag->id,
        }
        DB::table('thread_tags')->insert([
            
        ]);

        $data=[
          'title' => $title,
          'createdUser' => $user->name,
          'overview' => $overview,
          'tags' => $tags,
          'endAt' => $endAt,   
        ];

        return view('thread_index', ['data' => $data]);
    }
}
