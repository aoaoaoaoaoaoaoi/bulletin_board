<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Thread extends Model
{
    public function searchThread(Carbon $startAtFrom, Carbon $startAtTo, Carbon $endAtFrom, Carbon $endAtTo, string $title){
        self::StartAtFrom($startAtFrom)
            ->StartAtEnd($startAtTo)
            ->EndAtFrom($endAtFrom)
            ->EndAtTo($endAtTo)
            ->Title($titile);
    }

    public function scopeStartAtFrom($query, Carbon $startAt){
        if(empty($startAt)){
            return $query;
        }
        return $query->where('start_at', '>=', $startAt);
    }

    public function scopeStartAtTo($query, Carbon $startAt){
        if(empty($startAt)){
            return $query;
        }
        return $query->where('start_at', '<=', $startAt);
    }

    public function scopeEndAtFrom($query, Carbon $endAt){
        if(empty($endAt)){
            return $query;
        }
        return $query->where('end_at', '>=', $endAt);
    }

    public function scopeEndAtTo($query, Carbon $endAt){
        if(empty($endAt)){
            return $query;
        }
        return $query->where('end_at', '<=', $endAt);
    }

    public function scopeTitle($query, String $title){
        if(empty($title)){
            return $query;
        }
        return $query->where('title', 'LIKE', "%$title%");
    }
}
