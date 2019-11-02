<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisterMember extends Model
{
    protected $table = "registraion";

    protected $fillable = [
        "userId",
        "name",
        "father_name",
        "gender",
        "division",
        "district",
        "upazila",
        "is_union",
        "up_or_pouro_name",
        "villege",
        "votkendro",
        "national_id",
        "mobile_no"
    ];
}
