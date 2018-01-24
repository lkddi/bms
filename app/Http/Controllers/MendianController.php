<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mendian;
class MendianController extends Controller
{
    //
    public function index()
    {
    	$mendians = Mendian::all();
    	foreach ($mendians as $key => $value) {
    		print_r($value->mdname);
    	}
    }
}
