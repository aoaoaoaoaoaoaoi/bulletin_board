<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use DB;
use Auth;

class JoinGroupController extends Controller
{
    public function index()
    {
        $groups = DB::table('groups')->get();
        $user = Auth::user();
        $userJoinGroups = DB::table('player_groups')->where('player_id', '=', $user['id'])->get();
        $data=[];
        foreach ($groups as $group)
        {
            $isJoin = $userJoinGroups->where('group_id', '=', $group->id)->first();
            $groupData=[
                'id' => $group->id,
                'name' => $group->name,
                'description' => $group->description,
                'isJoin' => $isJoin !== null,
            ];
            $data[] = $groupData;
        }
        return view('join_group', ['data' => $data]);
    }

    public function joinGroup(Request $request)
    {
        $user = Auth::user();
        $joinGroups = $request->input('isJoin');
        $insertData=[];
        foreach ($joinGroups as $group) 
        {
            $data = [
                'player_id' => $user->id,
                'group_id' => $group,
            ];
            $insertData[] = $data;
        }
        DB::table('player_groups')->insert($insertData);
        return view('/join_group_complete');
    }
}
