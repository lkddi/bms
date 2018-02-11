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
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }




	public function cxbenzhou(Request $request)
	{
        $mdname = $request->input('mdname');
        $quyuid = $request->input('quyu_id');
        $qudaoid = $request->input('qudao_id');
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
            ->where(function($query){
                $query->where('state', 1);
            })
					->whereBetween('date',[date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),date("d")-date("w")+1,date("Y"))),date("Y-m-d H:i:s",mktime(23,59,59,date("m"),date("d")-date("w")+7,date("Y")))])
					->paginate(20);
        $lists->withPath('/cxbz?'.$cxname.'='.$cxs);
		return view('home.chaxun.cxbenzhou', ['list' => $lists,'name' =>$mdname,'mdnames' => $mdnames, 'quyus'=>$quyus, 'qudao'=>$qudaos]);
	}

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function cxbenyue(Request $request)
	{
        $mdname = $request->input('mdname');
        $quyuid = $request->input('quyu_id');
        $qudaoid = $request->input('qudao_id');
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
            ->where(function($query){
                $query->where('state', 1);
            })
            ->whereMonth('date',$ddd)
            ->paginate(20);
        $lists->withPath('/cxby?'.$cxname.'='.$cxs);
        return view('home.chaxun.cxbenyue', ['list' => $lists,'name' =>$mdname,'mdnames' => $mdnames, 'quyus'=>$quyus, 'qudao'=>$qudaos]);

    }
    public function edit(Sale $sale)
    {
        dd($sale);
    }
    public function c()
    {
//        $lists =Sale::where([
//            'stae'
//            ])-get();
//        dd($lists);
//        $app = app('wechat.official_account');
//        $userlists= $app->user->get('o4wryw5WjWHbIZh4qQvmH0YImfdo');
//        $userlists = $app->user_tag->list();
//        $userlists = $app->user->blacklist($beginOpenid = null); // $beginOpenid 可选
//        $app->user
//        打赏作者
        dd($userlists);
//https://mp.weixin.qq.com/cgi-bin/singlesendpage?tofakeid=o4wryw5WjWHbIZh4qQvmH0YImfdo&t=message/send&action=index&quickReplyId=600574476&token=494008511&lang=zh_CN
//        $list = $app->menu->list();
//        $current = $app->menu->current();
//
//        dd($current);
//        //设置菜单
//        $buttons = [
//            [
//                "type" => "click",
//                "name" => "销售查询",
//                "key"  => "V1001_TODAY_MUSIC"
//            ],
//            [
//                "name"       => "菜单",
//                "sub_button" => [
//                    [
//                        "type" => "view",
//                        "name" => "本周数据",
//                        "url"  => "http://wx.ay.lc/cxbz"
//                    ],
//                    [
//                        "type" => "view",
//                        "name" => "本月数据",
//                        "url"  => "http://"
//                    ],
//                ],
//            ],
//        ];
      //  $app->menu->create($buttons);
        //标记零售价
//        $lists  = Db::table('sales')
//            ->leftJoin('modes','modes.jmodel', '=', 'sales.model')
////            ->join('qudaos', 'qudaos.id', '=', 'qudao_id')
//            ->select('sales.*', 'modes.price as lsjg')
//
//            ->get();
////        $lists = Sale::all();
////        dd($lists);
//        foreach ($lists as $list){
//            $sale = Sale::find($list->id);
//            $sale->price = $list->lsjg;
//            $sale->save();
//            echo $list->id;
//        }

//获取文件md5
//        $lists = Sale::all();
//        foreach ($lists as $list)
//        {
//            $url = $list->image;
//            echo $url."==";
//            echo md5_file($url);
//            echo "<br>";
//            $sale = Sale::find($list->id);
//            $sale->md5 = md5_file($url);
//            $sale->save();
//        }
//echo md5_file('http://mmbiz.qpic.cn/mmbiz_jpg/tbwibWpmks0QU263PsDvibzKcbKUeTM4zwqmJ0yRmMrkBQth8ya4UOvqvEJVC4svUsJtOXvH12Txy0qxhbRUCicNw/0');
    }



}
