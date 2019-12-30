<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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


        
        return view('/make_group');
    }
}
