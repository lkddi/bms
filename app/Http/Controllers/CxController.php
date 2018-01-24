<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quyu;
use App\Mendian;
use App\Mode;
use App\Sale;
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
		$qyid = $request->input('qyid');
		$type = $mdname ?? 1;
		$mdnames = Mendian::all();
		$quyus = Quyu::all();
		$lists = Sale::where('mdname',$mdname)
					->whereBetween('date',[date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),date("d")-date("w")+1,date("Y"))),date("Y-m-d H:i:s",mktime(23,59,59,date("m"),date("d")-date("w")+7,date("Y")))])
					->paginate(20);

		return view('cxbenzhou', ['list' => $lists,'name' =>$mdname,'mdnames' => $mdnames, 'quyus'=>$quyus]);
	}

	public function cxbenyue(Request $request)
	{
		$mdname = $request->input('mdname');
		$qyid = $request->input('qyid');
		$type = !$mdname ?? '1';

		$mdnames = Mendian::all();
		$quyus = Quyu::all();

		$ddd = date('m',time());

		$lists = Sale::where($cxname,$mdname)
					->whereMonth('date',$ddd)
					->paginate(20);	
		return view('cxbenyue', ['list' => $lists,'name' =>$mdname,'mdnames' => $mdnames, 'quyus'=>$quyus]);
	}

	public function c()
	{
		$md = Mendian::all()->cxqys();
		// dd($md);
		// print_r($dm->mdname);

		foreach ($md as $flight) {
		    echo $flight->mdname;
		}
	}

}
