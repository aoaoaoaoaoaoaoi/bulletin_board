<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserThreadMessageReaction extends Model
{
    public function scopeThreadMessageIdAndReactionType($query, int $threadMessageId, int $reactionType){
        return $query->where('thread_message_id', '=', $threadMessageId)->where('reaction_type', '=', $reactionType);
    }
}
