<?php

namespace App\Http\Controllers\Admin;

use App\Sale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin:admin');
    }


    public function index()
    {
        $sale = Sale::where('id', '>', 0)->paginate(20);
//        $sale = DB::table('sales')->where('id', '>', 0)->paginate(20);
        return view('admin.sale.index',['sales' =>$sale]);
    }
}
