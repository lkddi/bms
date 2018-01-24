<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Quyu;
use App\Mendian;
use App\Mode;
use App\Sale;
use App\Qudao;
class CxController extends Controller
{
    //
    	//	查询所有数据
	public function index(Request $request)
	{
		$mdname = $request->input('mdname');
		$qyid = $request->input('qyid');
		$x = $request->input('x');
		// print_r($mdname);
		$type = $mdname ?? 1;
		$mdnames = Mendian::all();
		$quyus = Quyu::all();
		if ($type) {
			$lists = Sale::whereBetween('date',[date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),date("d")-date("w")+1,date("Y"))),date("Y-m-d H:i:s",mktime(23,59,59,date("m"),date("d")-date("w")+7,date("Y")))])
			->paginate(20);

		}else{

			if ($x =='本周') {
				// echo date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),date("d")-date("w")+1,date("Y"))),"\n";  
	   //  		echo date("Y-m-d H:i:s",mktime(23,59,59,date("m"),date("d")-date("w")+7,date("Y"))),"\n";
				$lists = Sale::where('mdname',$mdname)
							->whereBetween('date',[date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),date("d")-date("w")+1,date("Y"))),date("Y-m-d H:i:s",mktime(23,59,59,date("m"),date("d")-date("w")+7,date("Y")))])
							->paginate(20);
	    		
			}elseif ($x =='本月') {
				$ddd = date('m',time());

				$lists = Sale::where('mdname',$mdname)
							->whereMonth('date',$ddd)
							->paginate(20);			
			}
		}

		
		return view('quire', ['list' => $lists,'name' =>$mdname,'mdnames' => $mdnames, 'quyus'=>$quyus]);
	}


	public function cxbenzhou(Request $request)
	{
        $mdname = $request->input('mdname');
        $quyuid = $request->input('qyid');
        $qudaoid = $request->input('qdid');
        $mdnames = Mendian::all();
        $quyus = Quyu::all();
        $qudaos = Qudao::all();
        $tj = '=';
        if ($mdname){
            $cxname = 'mdname';
            $cxs = $mdname;
        }elseif ($quyuid){
            $cxname = 'quyu_id';
            $cxs = $quyuid;
            $mds = Quyu::where('id',$quyuid)->first();
            $mdname = $mds->qyname.'区域';
        }elseif ($qudaoid){
            $cxname = 'qudao_id';
            $cxs = $qudaoid;
            $mds = Qudao::where('id',$qudaoid)->first();
            $mdname = $mds->qdname.'';
        }else{
            $cxname = 'id';
            $cxs = 0;
            $tj = '>';
        }

		$lists = Sale::where($cxname,$tj,$cxs)
					->whereBetween('date',[date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),date("d")-date("w")+1,date("Y"))),date("Y-m-d H:i:s",mktime(23,59,59,date("m"),date("d")-date("w")+7,date("Y")))])
					->paginate(20);

		return view('cxbenzhou', ['list' => $lists,'name' =>$mdname,'mdnames' => $mdnames, 'quyus'=>$quyus, 'qudao'=>$qudaos]);
	}

	public function cxbenyue(Request $request)
	{
        $mdname = $request->input('mdname');
        $quyuid = $request->input('qyid');
        $qudaoid = $request->input('qdid');
        $mdnames = Mendian::all();
        $quyus = Quyu::all();
        $qudaos = Qudao::all();
        $tj = '=';
        if ($mdname){
            $cxname = 'mdname';
            $cxs = $mdname;
        }elseif ($quyuid){
            $cxname = 'quyu_id';
            $cxs = $quyuid;
            $mds = Quyu::where('id',$quyuid)->first();
            $mdname = $mds->qyname.'区域';
        }elseif ($qudaoid){
            $cxname = 'qudao_id';
            $cxs = $qudaoid;
            $mds = Qudao::where('id',$qudaoid)->first();
            $mdname = $mds->qdname.'';
        }else{
            $cxname = 'id';
            $cxs = 0;
            $tj = '>';
        }
        $ddd = date('m',time());
        $lists = DB::table('sales')->where($cxname,$tj,$cxs)
            ->whereMonth('date',$ddd)
            ->paginate(20);
        return view('cxbenyue', ['list' => $lists,'name' =>$mdname,'mdnames' => $mdnames, 'quyus'=>$quyus, 'qudao'=>$qudaos]);

    }

    public function c()
    {
        $lists = Sale::all();
        foreach ($lists as $list){
           echo $list->mdname;
           $mds = Mendian::where('mdname',$list->mdname)->first();
           echo "=";
           echo $mds->qudao_id;
           echo "<br>";
            $id = DB::table('sales')
                ->where('id', $list->id)
                ->update(['quyu_id'=>$mds->quyu_id, 'qudao_id'=>$mds->qudao_id]);
        }
    }


}
