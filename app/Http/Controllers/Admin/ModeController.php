<?php

namespace App\Http\Controllers\Admin;

use App\Mode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModeController extends Controller
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
        return view('admin.model.index');
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
     * @param  \App\Mode  $mode
     * @return \Illuminate\Http\Response
     */
    public function show(Mode $mode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mode  $mode
     * @return \Illuminate\Http\Response
     */
    public function edit(Mode $mode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mode  $mode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mode $mode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mode  $mode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mode $mode)
    {
        //
    }
}
