<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Thread;
use App\ThreadMessage;
use App\User;
use App\UserGroup;
use Carbon\Carbon;
use DB;
use Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $userId = (int)$request->input('userId');
        $user = User::where('id', '=', $userId)->first();
        $ownerThreadIds = ThreadMessage::getOwnedThreadIds($userId);
        $threads = Thread::whereIn('id', $ownerThreadIds)->orderBy('updated_at', 'desc')->get()->toArray();
        
        $data = [
            'name' => $user['name'],
            'profile' => $user['profile'],
            'resource' => $user['resource'],
            'thread_count' => count($threads),
        ];

        return view('user_index', ['data' => $data]);
    }
}
