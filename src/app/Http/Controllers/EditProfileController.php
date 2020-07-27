<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use DB;
use Auth;
use App\User;

class EditProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $tagData=DB::table('tags')->get();
        $tags=[];
        foreach ($tagData as $d){
            $tags[]=[
                'name' => $d->name,
            ];
        }

        $userTagIds = DB::table('user_tags') -> where('user_id', '=', $user['id'])->get()->pluck('tag_id');
        $userTagData = DB::table('tags')->whereIn('id', $userTagIds)->pluck('name')->toArray();
        $userTagValue = implode(",", $userTagData);

        $resoucePath = "../../../icon_image/".$user->resource;
        $data = [
            'name' => $user->name,
            'profile' => $user->profile,
            'resource' => $resoucePath,
            'user_tag_value' => $userTagValue,
            'tag' => $tags,
        ];
        return view('edit_profile', ['data' => $data]);
    }

    public function saveProfile(Request $request)
    {
        $user = Auth::user();
        $userData = User::where('id', '=', $user['id'])->first();

        // ファイル名を取得して、ユニークなファイル名に変更
        $file_name = $_FILES['icon-file']['name'];
        if($file_name !== "") {            
            $uniq_file_name = date("YmdHis") . "_" . $file_name;
            ResourceService::getInstance()->saveIconResouce($uniq_file_name, "icon-file", "icon_image");
            $userData->resource = $uniq_file_name;
        }

        $name = $request->input('username');
        $profile = $request->input('bio');
        $userData->name = $name;
        $userData->profile = $profile;
        $userData->save();

        $tagsValue = $request->input('usertag');
        $tags = TagService::getInstance()->insertTag($threadTags);

        $tagDatas = DB::table('tags')->whereIn('name', $tags)->get()->pluck('id')->toArray();
        $userTags = DB::table('user_tags') -> where('user_id', '=', $user['id'])->get()->pluck('tag_id')->toArray();
        $sameTags = array_intersect($tagDatas, $userTags);

        $deleteUserTags = array_diff($sameTags, $userTags);
        $insertUserTags = array_diff($sameTags, $tagDatas);

        DB::table('user_tags')->where('user_id', '=', $user['id'])->whereIn('tag_id', $deleteUserTags)->delete();
        $insertUserTagData=[];
        foreach ($insertUserTags as $insertUserTag){
                $data=[
                    'user_id' => $user['id'],
                    'tag_id' => $insertUserTag,
                ];
                $insertUserTagData[] = $data;
        }
        DB::table('user_tags')->insert($insertUserTagData);
    }
}
