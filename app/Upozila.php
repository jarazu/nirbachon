<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upozila extends Model
{
    protected $table = "upozila";

    public function prounion()
    {
        return $this->hasMany(PouroUnion::class,'upozila_id');
    }
}
