<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use DB;
use Auth;

class EditProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = [
            'name' = $user->name,
            'profile' = $user->profile,
            'resource' = $user->resource,
        ];
        return view('edit_profile', ['data' => $data]);
    }
}
