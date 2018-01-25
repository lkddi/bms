<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mendian;
class MendianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin:admin');
    }

    public function index()
    {
        $qudaos = Mendian::all();
        return view('admin.mendian.index',['qudao'=>$qudaos]);
    }
}
