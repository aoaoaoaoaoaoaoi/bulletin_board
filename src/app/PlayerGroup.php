<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerGroup extends Model
{
    /**
     * ユーザーIDとグループのフィルター
     */
    public function scopeUserAndGroup($query, int $userId, int $groupId) : \Illuminate\Database\Eloquent\Builder
    {
        return $query->where('player_id', '=', $userId)->where('group_id', '=', $groupId);
    }
}
