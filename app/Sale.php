<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //
    //
    public function cxall()
    {
    	 return $this->hasMany('App\Mendian');
    }
    public function cxy()
    {

    }
}
