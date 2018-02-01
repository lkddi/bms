<?php

namespace App\Http\Controllers;

use App\Sale;
use Illuminate\Http\Request;
use App\Mendian;
use App\Quyu;
use App\Qudao;
use Illuminate\Support\Facades\DB;
class SaleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $mdname = $request->input('mdname');
        $quyuid = $request->input('quyu_id');
        $qudaoid = $request->input('qudao_id');
        $mdnames = Mendian::all();
        $quyus = Quyu::all();
        $qudaos = Qudao::all();
        $tj = '=';
        if ($mdname){
            $cxname = 'mdname';
            $cxs = $mdname;
        }elseif ($quyuid){
            $cxname = 'quyu_id';
            $cxs = $quyuid;
            $mds = Quyu::where('id',$quyuid)->first();
            $mdname = $mds->qyname.'区域';
        }elseif ($qudaoid){
            $cxname = 'qudao_id';
            $cxs = $qudaoid;
            $mds = Qudao::where('id',$qudaoid)->first();
            $mdname = $mds->qdname.'';
        }else{
            $cxname = 'id';
            $cxs = 0;
            $tj = '>';
        }
        $ddd = date('m',time());
        $lists = DB::table('sales')->where($cxname,$tj,$cxs)
//            ->whereMonth('date',$ddd)
            ->orderBy('date', 'desc')
            ->paginate(20);
        $lists->withPath('/sale?'.$cxname.'='.$cxs);
        return view('home.sale.index', ['list' => $lists,'name' =>$mdname,'mdnames' => $mdnames, 'quyus'=>$quyus, 'qudao'=>$qudaos]);

        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(sale $sale)
    {
//        dd($sale);
        return view('home.sale.edit',['sale' =>$sale]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sale $sale)
    {

        $sale->mdname = $request->mdname;
        $sale->model = $request->model;
        $sale->amount = $request->amount;
        $sale->arbitrary = $request->arbitrary;
        $sale->save();
        return redirect()
            ->route('sale.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(sale $sale)
    {
//       dd($sale->image);
        Storage::disk('bms')->delete($sale->image);  //然后在filesystem里设置 uploads在storage下的路径
        $sale->delete();
        return redirect()
            ->route('sale.index');
    }
}
