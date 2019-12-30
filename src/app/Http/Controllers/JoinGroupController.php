<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use DB;

class JoinGroupController extends Controller
{
    public function index()
    {
        $data = DB::table('groups')->get();
        return view('join_group', ['data' => $data]);
    }

    public function joinGroup()
    {


        return view('/make_group_complete');
    }
}
