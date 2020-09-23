<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use App\Thread;
use App\ThreadMessage;
use App\Tag;
use App\ThreadTag;
use App\Group;
use App\UserGroup;

class SearchUserController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $groups = Group::get();
        $groupsData=[];
        foreach ($groups as $group)
        {
            $groupData=[
                'name' => $group->name,
                'id' => $group->id,
            ];
            $groupsData[] = $groupData;
        }
        return view('search_user_index', ['groups' => $groupsData]);
    }

    public function searchUser(Request $request)
    {
        $groupId = (int)$request->input('groupId');
        $userIds = UserGroup::Group($groupId)->select('user_id')->get();
        $users = User::whereIn('id', $userIds)->get();
        $data = [];
        foreach($users as $user){
            $lastLoginAt = $user['last_login_at'] != null ? new Carbon($user['last_login_at']) : null;
            $userData = [
                'id' => $user['id'],
                'resource' => $user['resource'],
                'name' => $user['name'],
                'profile' => $user['profile'],
                'lastLoginAt' => $lastLoginAt->year . "年" . $lastLoginAt->month . "月" . $lastLoginAt->day . "日",
            ];
            $data[] = $userData;
        }
        return json_encode($data);
    }
}
