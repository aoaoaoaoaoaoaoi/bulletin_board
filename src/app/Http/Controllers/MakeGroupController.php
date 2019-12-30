<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use DB;

class MakeGroupController extends Controller
{
    public function index()
    {
        return view('make_group');
    }

    public function makeGroup(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');

        DB::table('groups')->insert([
            'name' => $name,
            'description' => $description,
        ]);

        return view('/make_group');
    }
}
