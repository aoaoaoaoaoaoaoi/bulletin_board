<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    /**
     * ユーザーIDとグループのフィルター
     */
    public function scopeUserAndGroup($query, int $userId, int $groupId) : \Illuminate\Database\Eloquent\Builder
    {
        return $query->where('user_id', '=', $userId)->where('group_id', '=', $groupId);
    }
}
