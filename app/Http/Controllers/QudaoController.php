<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Qudao;
use App\Quyu;
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
        $quyus = Quyu::all();
        return view('home.qudao.add',['quyus'=>$quyus]);

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
            'qdname' => 'required',
            'quyu_id' =>'required|integer',
        ], [
            'required' => ':attribute 为必填项',
            'integer' =>':attribute 必须为数字',
        ],[
            'qdname'=>'渠道名称',
            'quyu_id'=>'区域',
        ]);
        $qudao = new Qudao;
        $qudao->qdname = $request->qdname;
        $qudao->quyu_id = $request->quyu_id;
//        dd($mode);
        $qudao->save();
        return redirect()
            ->route('qudao.index');
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
        $quyus = Quyu::all();
        return view('home.qudao.edit',['qudao'=>$qudao, 'quyus'=>$quyus]);

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
        $qudao->qdname = $request->qdname;
        $qudao->quyu_id = $request->quyu_id;
//        dd($mendian);
        $qudao->save();
        return redirect()
            ->route('qudao.index');
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
