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
        $threads = DB::table('threads')->get()->orderBy('updated_at', 'desc')->toArray();
        $data = [
            'threads' => $threads,
        ];
        return view('home', ['data' => $data]);
    }
}
