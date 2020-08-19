<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
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

        $data = [
            'name' => $group->name,
            'description' => $group->description,
            'resource' => $group->resource,
            'member_count' => $userCount,
        ];

        return view('group_index', ['data' => $data]);
    }
}
