<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use DB;

class MakeGroupController extends Controller
{
    public function index()
    {
        return view('make_group', ['resource' => ""]);
    }

    public function makeGroup(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');

        // ファイル名を取得して、ユニークなファイル名に変更
        $file_name = $_FILES['icon-file']['name'];
        $uniq_file_name = "";
        if($file_name !== "") {            
            $uniq_file_name = date("YmdHis") . "_" . $file_name;
            ResourceService::getInstance()->saveIconResouce($uniq_file_name, "icon-file", "icon_image");
        }

        DB::table('groups')->insert([
            'name' => $name,
            'description' => $description,
            'resource' => $uniq_file_name,
        ]);

        return view('/make_group_complete');
    }
}
