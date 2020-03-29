<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use DB;
use Auth;

class MakeThreadController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userJoinGroupIds = DB::table('player_groups')->where('player_id', '=', $user['id'])->get()->pluck('id');
        $userJoinGroupInfo = DB::table('groups')->whereIn('id', $userJoinGroupIds)->get();
        $data=[];
        foreach ($userJoinGroupInfo as $groupInfo)
        {
            $groupData=[
                'name' => $groupInfo->name,
            ];
            $data[] = $groupData;
        }
        return view('make_thread_index', ['joinGroup' => $data]);
    }

    public function makeThread(Request $request)
    {
        $title = $request->input('title');
        $group = $request->input('group');
        $threadTags = $request->input('usertag');
        $threadOverview = $request->input('threadOverview');
        
    }
}
