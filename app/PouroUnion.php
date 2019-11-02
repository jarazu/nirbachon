<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PouroUnion extends Model
{
    protected $table = "pouro_or_union";

    public function upozila()
    {
        return $this->belongsTo(Upozila::class,'upozila_id');
    }

    public function villages()
    {
        return $this->hasMany(Village::class,'pouro_or_union_id');
    }
}
