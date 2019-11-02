<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $table = "villege";


    public function prounion()
    {
        return $this->belongsTo(PouroUnion::class,'pouro_or_union_id');
    }

    public function votekandros()
    {
        return $this->belongsToMany(Votekendro::class,'villege_kendro','village_id','kendro_id');
    }
}
