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
        $file_name = $_FILES['icon-image']['name'];
        $uniq_file_name = date("YmdHis") . "_" . $file_name;
        
        // 仮にファイルがアップロードされている場所のパスを取得
        $tmp_path = $_FILES['upfile']['tmp_name'];
        
        // 保存先のパスを設定
        $upload_path = '../../../public/icon_image';
        
        if (is_uploaded_file($tmp_path)) {
        // 仮のアップロード場所から保存先にファイルを移動
            if (move_uploaded_file($tmp_path, $upload_path . $uniq_file_name)) {
                // ファイルが読出可能になるようにアクセス権限を変更
                chmod($upload_path . $uniq_file_name, 0644);
            }
        }

        $name = $request->input('name');
        $profile = $request->input('profile');

        $tag = $request->input('user_tags');
    }
}
