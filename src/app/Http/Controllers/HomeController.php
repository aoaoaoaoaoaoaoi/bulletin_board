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
        
        $joinGroupIds = DB::table('player_groups')->where('player_id', '=', $user['id'])->get()->pluck('group_id');
        $joinGroups = DB::table('groups')->whereIn('id', $joinGroupIds)->get();
        $groups=[];
        foreach ($joinGroups as $joinGroup){
            $g = [
                'name' => $joinGroup->name,
            ];
            $groups[] = $g;
        }
        
        $data = [
            'name' => $user->name,
            'profile' => $user ->profile,
            'groups' => $groups,
        ];
        return view('home', ['data' => $data]);
    }
}
