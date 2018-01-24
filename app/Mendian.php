<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Quyu;
class Mendian extends Model
{
	//protected $hidden = ['id', 'mdname', 'mdpy', 'quyu_id', 'dudao_id'];

    //
    public function cxqys()
    {
    	 // return $this->hasOne('App\Quyu');
    	 return $this->hasOne('App\Quyu', 'id', 'quyu_id');

    }
}
