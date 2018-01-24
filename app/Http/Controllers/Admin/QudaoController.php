<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Qudao;
class QudaoController extends Controller
{
    public function index()
    {
        $qudaos = Qudao::all();
        return view('admin.qudao.index',['qudao'=>$qudaos]);
    }
}
