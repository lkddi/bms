<?php

namespace App\Http\Controllers\Admin;

use App\Mendian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MendianController extends Controller
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
        $qudaos = Mendian::all();
        return view('admin.mendian.index',['qudao'=>$qudaos]);
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
     * @param  \App\Mendian  $mendian
     * @return \Illuminate\Http\Response
     */
    public function show(Mendian $mendian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mendian  $mendian
     * @return \Illuminate\Http\Response
     */
    public function edit(Mendian $mendian)
    {
        //$data = $this->dispatch(new PostFormFields($id));

        return view('admin.mendian.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mendian  $mendian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mendian $mendian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mendian  $mendian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mendian $mendian)
    {
        //
    }
}
