<?php

namespace App\Http\Controllers\Admin;

use App\Quyu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuyuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin:admin');
    }


    public function index()
    {
        $quyus = Quyu::all();
        return view('admin.quyu.index',['quyu'=>$quyus]);
    }
}
