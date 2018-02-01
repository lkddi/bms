<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mendian extends Model
{
    //
    public function quyu()
    {
        return $this->hasOne(Quyu::class,'id','quyu_id');
    }
}
