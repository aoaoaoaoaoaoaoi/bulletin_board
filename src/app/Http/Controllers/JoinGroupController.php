<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PlayerGroup;
use App\Group;
use DB;
use Auth;

class JoinGroupController extends Controller
{
    public function index()
    {
        return view('join_group');
    }

    public function reverseParticipation(Request $request)
    {
        $user = Auth::user();
        $groupId = (int)$request->input('groupId');
        $joinData = PlayerGroup::UserAndGroup($user->id, $groupId);
        $isJoin = false;
        if($joinData->count() <= 0){
            PlayerGroup::insert(['player_id' => $user->id, 'group_id' => $groupId]);
            $isJoin = true;
        }else{
            $joinData->delete();
        }
        return json_encode(['isJoin' => $isJoin]);
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

        $groups = Group::GroupName($groupName);
       
        $data = self::organizeGroupData($groups);
        return json_encode($data);
    }

    private function  organizeGroupData(\Illuminate\Support\Collection $groups) : array
    {
        $data = [];

        //ユーザーの参加しているグループ
        $user = Auth::user();
        $joinGroupIds = PlayerGroup::where('player_id', '=', $user->id)->get(['group_id']);
        $joinGroups = [];
        foreach($joinGroupIds as $id){
            $joinGroups[$id['group_id']] = true;
        }

        //グループの参加人数
        $groupIds = $groups->pluck('id')->toArray();
        $joinCountData = PlayerGroup::whereIn('group_id', $groupIds)->select(DB::raw('count(*) as number_of_people, group_id'))->groupBy('group_id')->get();
        $joinCounts = [];
        foreach($joinCountData as $countData){
            $joinCounts[$countData->group_id] = $countData->number_of_people;
        }
        
        foreach($groups as $group){
            $groupData = [
                'resource' => $group->resource,
                'name' => $group->name,
                'id' => $group->id,
                'description' => $group->description,
                'joinCount' => isset($joinCounts[$group->id]) ? $joinCounts[$group->id] : 0,
                'isJoin' => isset($joinGroups[$group->id]),
            ];
            $data[] = $groupData;
        }
        return $data;
    }
}
