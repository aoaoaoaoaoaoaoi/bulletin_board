<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use DB;
use Auth;
use App\User;

class TagService
{
    final protected function __construct() {}

    final public static function getInstance()
    {
        static $instance;
        if (!$instance) {
            $instance = new static;
        }
        return $instance;
    }
    
    public function insertTag($tagsValue)
    {
        $tags = explode(',', $tagsValue);
        $allTags = DB::table('tags')->orderBy('name')->get()->pluck('name');
        $insertTagData = [];
        $allIndex = 0;
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
        return $tags;
    }
}