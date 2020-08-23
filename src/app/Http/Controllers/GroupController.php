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
        $threads = Thead::GroupId('group_id', '=', $groupId)->orderBy('updated_at', 'desc');
        $organizedThreads = ThreadService::getInstance()->organizeThreadData($threads);
        
        $data = [
            'name' => $group->name,
            'description' => $group->description,
            'resource' => $group->resource,
            'member_count' => $userCount,
        ];

        return view('group_index', ['data' => $data, 'thread' => $organizedThreads]);
    }
}
