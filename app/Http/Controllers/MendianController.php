<?php

namespace App\Http\Controllers;
use App\Qudao;
use App\Quyu;
use Illuminate\Support\Facades\DB;
use App\Mendian;
use Illuminate\Http\Request;
class MendianController extends Controller
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
//        $mendians = Mendian::all();
        $mendians = Db::table('mendians')
            ->join('quyus','quyus.id', '=', 'quyu_id')
            ->join('qudaos', 'qudaos.id', '=', 'qudao_id')
            ->select('mendians.*', 'quyus.qyname', 'qudaos.qdname')
            ->orderBy('id', 'asc')
            ->get();
        return view('home.mendian.index',['mendians'=>$mendians]);

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
    public function edit(Request $request, Mendian $mendian)
    {
//        dd($mendian);

        $qudaos =Qudao::all();
        $quyus = Quyu::all();
        return view('home.mendian.edit',['mendian' =>$mendian, 'qudaos'=>$qudaos, 'quyus'=>$quyus]);

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
        $mendian->mdname = $request->mdname;
        $mendian->mdpy = $request->mdpy;
        $mendian->quyu_id = $request->quyu_id;
        $mendian->qudao_id = $request->qudao_id;
//        dd($mendian);
        $mendian->save();
        return redirect()
            ->route('mendian.index');
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
