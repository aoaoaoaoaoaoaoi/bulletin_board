<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Group;
use App\ThreadMessage;

class ThreadService
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
    
    public function organizeThreadData(array $threads) : array
    {
        $data = [];
        foreach($threads as $thread){
            $messageCount = ThreadMessage::where('thread_id', $thread['id'])->count();
            $groupName = Group::where('id', $thread['group_id'])->first()->name;
            $startAt = new Carbon($thread['start_at']);
            $updateAt = new Carbon($thread['updated_at']);
            $diffMinites = $startAt->diffInSeconds($updateAt) / 60;
            $wave = round($messageCount / max(1, $diffMinites) * 60, 2);
            $threadData = [
                'id' => $thread['id'],
                'title' => $thread['title'],
                'updatedAt' => $updateAt->year . "年" . $updateAt->month . "月" . $updateAt->day . "日",
                'wave' => $wave,
                'groupName' => $groupName,
            ];
            $data[] = $threadData;
        }
        return $data;
    }
}