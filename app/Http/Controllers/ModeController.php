<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Mode;

class ModeController extends Controller
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
        $modes = Mode::all();
        return view('home.mode.index', ['modes'=>$modes]);
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
     * @param  \App\mode  $mode
     * @return \Illuminate\Http\Response
     */
    public function show(mode $mode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\mode  $mode
     * @return \Illuminate\Http\Response
     */
    public function edit(mode $mode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\mode  $mode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, mode $mode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\mode  $mode
     * @return \Illuminate\Http\Response
     */
    public function destroy(mode $mode)
    {
        //
    }
}
