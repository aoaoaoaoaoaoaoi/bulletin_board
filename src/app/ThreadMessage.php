<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThreadMessage extends Model
{
    public static function getOwnedThreadIds(int $userId)
    {
        return self::where('user_id', '=', $userId)->where('thread_order', '=', 1)->get('thread_id');
    }

    public static function getInvolvedThreadIds(int $userId)
    {
        return self::where('user_id', '=', $userId)->get('thread_id');
    }
}