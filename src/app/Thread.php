<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Thread extends Model
{
    public searchThread(Carbon $startAtFrom, Carbon $startAtTo, Carbon $endAtFrom, Carbon $endAtTo, string $title){
        this->StartAtFrom($startAtFrom)
            ->StartAtEnd($startAtTo)
            ->EndAtFrom($endAtFrom)
            ->EndAtTo($endAtTo)
            ->Title($titile);
    }

    public scopeStartAtFrom($query, Carbon $startAt){
        if(empty($startAt)){
            return $query;
        }
        return $query->where('start_at', '>=', $startAt);
    }

    public scopeStartAtTo($query, Carbon $startAt){
        if(empty($startAt)){
            return $query;
        }
        return $query->where('start_at', '<=', $startAt);
    }

    public scopeEndAtFrom($query, Carbon $endAt){
        if(empty($endAt)){
            return $query;
        }
        return $query->where('end_at', '>=', $endAt);
    }

    public scopeEndAtTo($query, Carbon $endAt){
        if(empty($endAt)){
            return $query;
        }
        return $query->where('end_at', '<=', $endAt);
    }

    public scopeTitle($query, String $title){
        if(empty($title)){
            return $query;
        }
        return $query->where('title', 'LIKE', "%$title%");
    }
}
