<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $joinGroups = DB::table('player_groups')->where('player_id', '=', $user['id'])->get();
        $data = [
            'name' => $user->name,
            'profile' => $user -> profile,
            'groups' => $joinGroups,
        ];
        return view('home', ['data' => $data]);
    }
}
