<?php

namespace App\Http\Controllers;

use App\Mendian;
use App\Qudao;
use App\Quyu;
use App\Sale;
use Illuminate\Http\Request;

class XlsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quyus = Quyu::all();
        $qudaos = Qudao::all();
        $mendians = Mendian::all();
        $month = date('y',time());
        return view('home.xls.index',['quyus'=>$quyus,'qudaos'=>$qudaos,'mendians'=>$mendians,'month'=>$month]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $mendianid = $request->input('mendian_id');
        $quyuid = $request->input('quyu_id');
        $qudaoid = $request->input('qudao_id');
        $month = $request->input('month');
//        if ($)
        
        dd($request->all());
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
