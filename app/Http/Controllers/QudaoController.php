<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Qudao;
use Illuminate\Http\Request;

class QudaoController extends Controller
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
    public function index()
    {
        $qudaos = Db::table('qudaos')
            ->join('quyus','quyus.id', '=', 'quyu_id')
            ->get();
        return view('home.qudao.index', ['qudaos'=>$qudaos]);
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
     * @param  \App\qudao  $qudao
     * @return \Illuminate\Http\Response
     */
    public function show(qudao $qudao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\qudao  $qudao
     * @return \Illuminate\Http\Response
     */
    public function edit(qudao $qudao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\qudao  $qudao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, qudao $qudao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\qudao  $qudao
     * @return \Illuminate\Http\Response
     */
    public function destroy(qudao $qudao)
    {
        //
    }
}
