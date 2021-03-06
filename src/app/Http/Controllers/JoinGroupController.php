<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\User;
use App\UserGroup;
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
        $joinData = UserGroup::UserAndGroup($user->id, $groupId);
        $isJoin = false;
        if($joinData->count() <= 0){
            UserGroup::insert(['user_id' => $user->id, 'group_id' => $groupId]);
            $isJoin = true;
        }else{
            $joinData->delete();
        }
        return json_encode(['isJoin' => $isJoin]);
    }

    public function showGroupInfo()
    {
        $groupId = $_POST['key'];
        $group = Group::where('id', '=', $groupId)->first();
        $memberIds = UserGroup::where('group_id', '=', $groupId)->get()->pluck('user_id');
        $members = User::whereIn('id', $memberIds)->get();
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
        $userIdParam = $request->input('userId');
        $userId = ($userIdParam == null) ? null : (int)$userIdParam;

        if($userId != null){
            $groupIds = UserGroup::where('user_id', '=', $userId)->get('group_id');
            $groups = Group::whereIn('id', $groupIds)->get();
        }else{
            $groups = Group::GroupName($groupName);
        }
       
        $data = self::organizeGroupData($groups);
        return json_encode($data);
    }

    private function organizeGroupData(\Illuminate\Support\Collection $groups) : array
    {
        $data = [];

        //ユーザーの参加しているグループ
        $user = Auth::user();
        $joinGroupIds = UserGroup::where('user_id', '=', $user->id)->get(['group_id']);
        $joinGroups = [];
        foreach($joinGroupIds as $id){
            $joinGroups[$id['group_id']] = true;
        }

        //グループの参加人数
        $groupIds = $groups->pluck('id')->toArray();
        $joinCountData = UserGroup::whereIn('group_id', $groupIds)->select(DB::raw('count(*) as number_of_people, group_id'))->groupBy('group_id')->get();
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
