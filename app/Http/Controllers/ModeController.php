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
        return view('home.mode.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'model' => 'required',
            'jmodel' =>'required',
            'price' =>'required|integer',
            'state' =>'required|integer',
        ], [
            'required' => ':attribute 为必填项',
            'integer' =>':attribute 必须为数字',
        ],[
            'model'=>'型号',
            'jmodel'=>'型号简称',
            'price'=>'零售价',
            'state'=>'状态',
        ]);
        $mode = new Mode;
        $mode->model = $request->model;
        $mode->jmodel = $request->jmodel;
        $mode->price = $request->price;
        $mode->state = $request->state;
//        dd($mode);
        $mode->save();
        return redirect()
            ->route('mode.index');
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
        return view('home.mode.edit',['mode' =>$mode]);
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
        $mode->model = $request->model;
        $mode->jmodel = $request->jmodel;
        $mode->price = $request->price;
        $mode->state = $request->state;
//        dd($mode);
        $mode->save();
        return redirect()
            ->route('mode.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\mode  $mode
     * @return \Illuminate\Http\Response
     */
    public function destroy(mode $mode)
    {
        $mode->delete();
        return redirect()
            ->route('mode.index');
    }
}
