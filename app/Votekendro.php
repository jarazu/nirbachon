<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Votekendro extends Model
{
    protected $table = "votkendro";

    public function villages()
    {
        return $this->belongsToMany(Votekendro::class,'villege_kendro','kendro_id','village_id');
    }
}
