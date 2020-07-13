<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function scopeGroupName($query, string $groupName) : \Illuminate\Support\Collection
    {
        if($groupName == null)
        {
            return $query->get();
        }
        return collect($query->whereRaw('replace(name, "　", "") = ?', [$groupName])->get());
    }
}
