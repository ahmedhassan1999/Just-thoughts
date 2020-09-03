<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded=[];
    public function permission()
    {
        return $this->belongsToMany(Permission::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
