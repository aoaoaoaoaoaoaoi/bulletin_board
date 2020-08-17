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
        return view('join_group');
    }
}
