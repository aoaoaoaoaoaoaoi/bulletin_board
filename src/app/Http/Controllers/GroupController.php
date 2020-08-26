<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Thread;
use App\User;
use App\UserGroup;
use DB;
use Auth;

class GroupController extends Controller
{
    public function index(Request $request)
    {
        $groupId = $request->input('groupId');
        $group = Group::where('id', '=', $groupId)->first();
        $userCount = UserGroup::where('group_id', '=', $groupId)->count();
        $threads = Thread::GroupId($groupId)->orderBy('updated_at', 'desc')->get()->toArray();
        
        $data = [
            'name' => $group->name,
            'description' => $group->description,
            'resource' => $group->resource,
            'member_count' => $userCount,
        ];

        return view('group_index', ['data' => $data]);
    }

    public function searchUser(Request $request)
    {
        $lastLoginAtData = Auth::user()->lastLoginAt;
        $lastLoginAt = $lastLoginAtData != null ? new Carbon($lastLoginAtData) : null;
        $groupId = (int)$request->input('groupId');
        $userIds = UserGroup::Group($groupId)->select('user_id')->get();
        $users = User::whereIn('id', $userIds)->get();
        $data = [];
        foreach($users as $user){
            $userData = [
                'resource' => $user['resource'],
                'name' => $user['name'],
                'profile' => $user['profile'],
                'lastLoginAt' => $lastLoginAt,
            ];
            $data[] = $userData;
        }
        return json_encode($data);
    }
}
