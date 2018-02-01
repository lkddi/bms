<?php

namespace App\Http\Controllers\Admin;

use App\Quyu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuyuController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.admin:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $qudaos = Quyu::all();
        return view('admin.quyu.index',['quyu'=>$qudaos]);
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
     * @param  \App\Quyu  $quyu
     * @return \Illuminate\Http\Response
     */
    public function show(Quyu $quyu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quyu  $quyu
     * @return \Illuminate\Http\Response
     */
    public function edit(Quyu $quyu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quyu  $quyu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quyu $quyu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quyu  $quyu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quyu $quyu)
    {
        //
    }
}
