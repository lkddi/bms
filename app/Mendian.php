<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mendian extends Model
{
	//protected $hidden = ['id', 'mdname', 'mdpy', 'quyu_id', 'dudao_id'];

    //
    public function cxqys()
    {
    	 return $this->hasOne('App\Quyu');
    }
}
