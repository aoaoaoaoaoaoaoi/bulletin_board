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
        $userTagDatas = DB::table('tags')->whereIn('id', $userTagIds)->get();
        $userTags = [];
        $userTagValue = '';
        foreach ($userTagDatas as $d){
            $userTagValue = $userTagValue.' #'.$d->name;
            $userTag=[
                'name' => '#'.$d->name,
            ];
            $userTags[] = $userTag;
        }

        $resoucePath = "../../../icon_image/".$user->resource;
        $data = [
            'name' => $user->name,
            'profile' => $user->profile,
            'resource' => $resoucePath,
            'user_tag' => $userTags,
            'user_tag_value' => $userTagValue,
            'tag' => $tags,
        ];
        return view('edit_profile', ['data' => $data]);
    }

    public function saveProfile(Request $request)
    {
        // ファイル名を取得して、ユニークなファイル名に変更
        $file_name = $_FILES['icon-file']['name'];
        $uniq_file_name = date("YmdHis") . "_" . $file_name;
        
        // 仮にファイルがアップロードされている場所のパスを取得
        $tmp_path = $_FILES['icon-file']['tmp_name'];
        
        // 保存先のパスを設定
        $upload_path = './icon_image/';
        
        if (is_uploaded_file($tmp_path)) {
        // 仮のアップロード場所から保存先にファイルを移動
            if (move_uploaded_file($tmp_path, $upload_path.$uniq_file_name)) {
                // ファイルが読出可能になるようにアクセス権限を変更
                chmod($upload_path . $uniq_file_name, 0644);
            }
        }

        $name = $request->input('username');
        $profile = $request->input('bio');
        $user = Auth::user();
        $userData = User::where('id', '=', $user['id'])->first();
        $userData->name = $name;
        $userData->resource = $uniq_file_name;
        $userData->profile = $profile;
        $userData->save();
        /*$userData = DB::table('users') 
                    -> where('id', '=', $user['id']) 
                    -> first()
                    -> update([
                        'user_name' => $name,
                        'resource' => $uniq_file_name,
                        'profile' => $profile,
                    ]);*/

        $tagsValue = $request->input('usertag');
        $tagsWithSymbol = explode(' ', $tagsValue);
        $allTags = DB::table('tags')->orderBy('name')->get()->pluck('name');
        //sort($allTags);
        $insertTagData = [];
        $allIndex = 0;
        $tags=[];
        foreach($tagsWithSymbol as $tag){
            $tags[] = ltrim($tag, '#');
        }
        sort($tags);
        foreach($tags as $tag){
            $isConfirm = false;
            for(; $allIndex < count($allTags); ++$allIndex){
                $cmp = strcmp($allTags[$allIndex], $tag);
                if($cmp == 0) break;
                if(0 < $cmp || $allIndex == count($allTags) - 1){
                    //タグが登録されてない
                    $data = [
                        'name' => $tag,
                    ];
                    $insertTagData[] = $data;
                    break;
                }
            }
        }
        DB::table('tags')->insert($insertTagData);

        $tagDatas = DB::table('tags')->whereIn('name', $tags)->get()->pluck('id')->toArray();
        $userTags = DB::table('user_tags') -> where('user_id', '=', $user['id'])->get()->pluck('tag_id')->toArray();
        $sameTags = array_intersect($tagDatas, $userTags);
        
        $deleteUserTags = array_diff($sameTags, $userTags);
        $insertUserTags = array_diff($sameTags, $tags);
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
