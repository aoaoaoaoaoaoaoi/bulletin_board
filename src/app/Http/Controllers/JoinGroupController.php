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

    public function searchGroup(Request $request)
    {
        $groupName = (string)$request->input('groupName');
        $tag = (string)$request->input('tag');

        $groups = collect(Group::whereRaw('replace(groupName, "　", "") = ?', [$groupName])->get());
        $data = self::organizeGroupData($groups);  
        return json_encode($data);
    }

    private function  organizeGroupData(array $groups) : array
    {
        $data = [];

        //ユーザーの参加しているグループ
        $user = Auth::user();
        $joinGroupIds = PlayerGroup::where('player_id', '=', $user->id)->get(['group_id']);
        $joinGroups = [];
        foreach($joinGroupIds as $id){
            $joinGroups[$id] = true;
        }

        //グループの参加人数
        $groupIds = $groups->pluck('id');
        $joinCounts = PlayerGroup::whereIn('group_id', '=', $groupIds)->select(DB::raw('count(*) as user_count, status'))->groupBy('group_id')->get();
        
        foreach($groups as $group){
            $groupData = [
                'resource' => $group['resource'],
                'name' => $group['name'],
                'desctiption' => $group['desctiption'],
                'joinCount' => $joinCounts[$group['id']],
                'isJoin' => isset($joinGroups[$group['id']]),
            ];
            $data[] = $groupData;
        }
        return $data;
    }
}
