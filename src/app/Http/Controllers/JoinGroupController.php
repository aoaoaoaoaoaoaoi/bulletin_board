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

    public function showGroupInfo()
    {
        $groupId = $_POST['key'];
        $group = DB::table('groups')->where('id', '=', $groupId)->first();
        $memberIds = DB::table('player_groups')->where('group_id', '=', $groupId)->get()->pluck('player_id');
        $members = DB::table('users')->whereIn('id', $memberIds)->get();
        $groupData=[
            'name' => $group->name,
            'description' => $group->description,
            'members' => $members,
        ];
        echo json_encode($groupData);
    }
}
