<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\UserGroup;
use App\Thread;
use App\ThreadMessage;
use Carbon\Carbon;
use DB;
use Auth;
use \App\Http\Controllers\TagService;

class MakeThreadController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userJoinGroupIds = UserGroup::where('user_id', '=', $user['id'])->get()->pluck('group_id');
        $userJoinGroupInfo = Group::whereIn('id', $userJoinGroupIds)->get();
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

        $insertResult = Thread::insert([
            'group_id' => $group,
            'title' => $title,
            'start_at' => $startAt,
            'end_at' => $endAt,
        ]);

        $insertId = DB::table('threads')->orderBy('id','Desc')->first();

        $insertResult = ThreadMessage::insert([
            'thread_id' => $insertId,
            'thread_order' => 1,
            'user_id' => $user->id,
            'message' => $overview,
            'posted_time' => Carbon::now(),
            'resource1' => null,
            'resource2' => null,
            'resource3' => null,
        ]);

        $tags = TagService::getInstance()->insertTag($threadTags);
        $tagIds = DB::table('tags')->whereIn('name', $tags)->get()->pluck('id');
        $insertData = [];
        foreach($tagIds as $tagId){
            $data = [
                'thread_id' => $insertId->id,
                'tag_id' => $tagId,
            ];
            $insertData[] = $data;
        }
        DB::table('thread_tags')->insert($insertData);

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
