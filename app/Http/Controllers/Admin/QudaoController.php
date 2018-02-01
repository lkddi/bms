<?php

namespace App\Http\Controllers\Admin;

use App\Qudao;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QudaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $qudaos = Qudao::all();
        return view('admin.qudao.index',['qudao'=>$qudaos]);
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
     * @param  \App\Qudao  $qudao
     * @return \Illuminate\Http\Response
     */
    public function show(Qudao $qudao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Qudao  $qudao
     * @return \Illuminate\Http\Response
     */
    public function edit(Qudao $qudao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Qudao  $qudao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Qudao $qudao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Qudao  $qudao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Qudao $qudao)
    {
        //
    }
}
