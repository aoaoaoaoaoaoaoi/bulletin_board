<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThreadMessage extends Model
{
    public function getOwnedThreadIds(int $userId)
    {
        return this::where('user_id', '=', $userId)->where('thread_order', '=', 1)->get('thread_id');
    }
}