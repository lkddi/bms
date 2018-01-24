<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Log;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use EasyWeChat\Kernel\Messages\News;
use EasyWeChat\Kernel\Messages\NewsItem;
use EasyWeChat\Kernel\Messages\Text;

use Illuminate\Http\Request;

use App\Quyu;
use App\Mendian;
use App\Mode;
use App\Sale;
class WeChatController extends Controller
{

    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        // Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志
        $app = app('wechat.official_account');
        $app->server->push(function($message){
               switch ($message['MsgType']) {
			        case 'event':
			            return '收到事件消息';
			            break;
			        case 'text':
			        	if ($message['Content'] == '删除') {
			        		$s = $this->del(0);
			        		return $s;
			        	}
						$hello = explode(' ',$message['Content']); 
						if ($hello['0']=='查询') {
							$url ='http://wx.ay.lc/quire?mdname='.$hello['1'].'&x='.$hello['2'];
							$items = [new NewsItem([
							        'title'       => $hello['1'].'本周数据',
							        'description' => '...',
							        'url'         => $url,
							        'image'       => 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1516180354113&di=27d010e8a7143000f5033de19fec839a&imgtype=0&src=http%3A%2F%2Fimages1.gbicom.cn%2Fuploads%2Fueditor%2F20161227%2F1482808201873457.png']),];
							return new News($items);
							// return new Text('Hello world!');
							// return 'dddddddd';
						}elseif ($hello['0']=='删除') {
							$s = $this->del($hello['1']);
			        		return $s;
						}

						if (count($hello) >= 3) {
							// $datas = [];
							// $datas =['mdname'=>$hello['0'], 'model' => $hello['1'], 'amount' =>$hello['3']];
							// $content = $this->add($data, 'text');
							$this->checkmd($hello['0']);//门店检查
							// checkmodel($hello['1']);//型号检查
							// return $hello['0'];
							$a = $this->add($hello,'text');
						}
						return $a;
			            // return $message['Content'].'收到文字消息'.$abc;
			            break;
			        case 'image':
			        	$content = $message['PicUrl'];
			        	$a = $this->add($message['PicUrl'],'image');

			            return $a;
			            break;
			        case 'voice':
			            return '收到语音消息';
			            break;
			        case 'video':
			            return '收到视频消息';
			            break;
			        case 'location':
			            return '收到坐标消息';
			            break;
			        case 'link':
			            return '收到链接消息';
			            break;
			        // ... 其它消息
			        default:
			            return '收到其它消息';
			            break;
			    	}
        });

        return $app->server->serve();
    }

    public function add($data,$type = 'image')
    {
    	// $data  = array();
    	// $data['PicUrl'] ='dddddddddddddd';
    	//写数据库，如果图片下载图片。   然后修改  内容 并修改图片 
	    $sales = Sale::where('state',0)->first();
    	if ($type == 'image') {
	    	// print_r($sales);
	    	// dd($sales);
	    	//
	    	if (!$sales) {
	    		
	    		$id = Sale::insertGetId(
				    ['image' => $data,'date'=>date('y-m-d',time())]
				);
				if ($id) {
					return '图片保存ok，请回复门店信息及型号价格，请用空格分开！';
				}else{
					return '图片保存失败，请重新发送！';
				}
	    		
	    	}else{
	    		return '上一张图片还未设置门店信息，如重新发送请先回复 删除';
	    	}

    	}else{
    		//如果type不是图片 对文字进行处理
    		if (!$sales) {
    			return '请先发给我图片！';
    		}else{
    			//下载图片到本地，储存到想要目录并改名
    			//url 远程图片地址
    			//file 文件名称
    			//path 保存路径

    			$file = $data['1']."_".date('Y-m-d-his',time()).".jpg";
    			$path = $data['0'];
    			$url = $sales->image;

    			$newurl = $this->down($url,$file,$path);

    			if ($newurl != false) {
    				$luanjia = $data['3'] ?? 0;

	     			$id = Sale::where('id', $sales->id)
					    ->update(['image'=>$newurl,'mdname' => $data['0'],'model' => $data['1'],'amount' => $data['2'],'state' => '1' ,'arbitrary' => $luanjia]);
					if ($id) {

						return '数据添加成功,ID:'.$sales->id.'-'.$data['0'] .'-'.$data['1'];

					}else{
						return '门店信息增加失败，从新发送门店信息！';
					}

	    		} 				
    		}
    	}
	}

    public function down($url,$file,$path)
    {//$url,$file,$name
    	// return 'dddddd';
    	// $url = 'http://mmbiz.qpic.cn/mmbiz_jpg/tbwibWpmks0QU263PsDvibzLCADicZibjOY4GlcibY1TbeWf64Tv9f23k9NhFc2aSleg65ngriaO9kKd8gxoNKyRa7IA/0';
    	// $file = './down/中文目录/sss/a.jpg';
  //   	$dirPath = 'test/abc';
		// Storage::makeDirectory($dirPath);
		// $directories = Storage::directories('test');
		// dd($directories);
		// 
		$y = date('m',time());
			$paths = "./down/$y/$path/";
			//判断目录存在否，存在给出提示，不存在则创建目录
			if (is_dir($paths)){  
				// echo "对不起！目录 " . $paths . " 已经存在！";
			}else{
				//第三个参数是“true”表示能创建多级目录，iconv防止中文目录乱码
				// $res=mkdir(iconv("UTF-8", "GBK", $path),0777,true); 
				$res=mkdir($paths,0777,true); 
				if ($res){
					// echo "目录 $paths 创建成功";
				}else{
					// echo "目录 $paths 创建失败";
					return false;
				}
			}
		$file = $paths.$file;
    	$client = new Client(['verify' => false]);  //忽略SSL错误
		$response = $client->get($url, ['save_to' => public_path($file)]);  //保存远程url到文件
		return $file;
    }
	public function c()
	{
		$ccc = 'aaaa';
		$ddd = $ccc !='' ? 'aaaa' :'bbbb';
		echo $ddd;
		// $qys =  Sale::where('state',0)->first();
		//   print_r($qys->id);
		//  foreach ($qys as $flight) {
		//     echo $flight->id;
		// }

	}

	//	查询数据
	public function quire(Request $request)
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

    public function del($id)
    {
    	if ($id >0) {
	     	$ids = DB::table('salelist')->where('id','=',$id)->delete();
	    	if ($ids) {
	    		return '删除成功';
	    	}else{
	    		return '删除失败！';
	    	} 
    	}else{
	     	$ids = DB::table('salelist')->where('state','=',0)->delete();
	    	if ($ids) {
	    		return '删除成功！';
	    	}else{
	    		return '删除失败';
	    	}   		
    	}


    }
    //型号检查 是否
    public function checkmodel()
    {

    }
    //门店检查  是否存在
    public function checkmd($mdname)
    {
    	$lists = DB::table('mdnames')->where('mdname',$mdname)->first();
    	$lists = Mendian::where('mdname',$mdname)->first();
    	if (!$lists) {
    		DB::table('mdnames')->insert(['mdname'=>$mdname]);
    		//return '添加门店成功';
    	}else{
    		//return "已经存在";
    	}
    }
    //价格检查  是否乱价
    public function checkprice()
    {

    }

/** 
 * 取汉字的第一个字的首字母 
 * @param type $str 
 * @return string|null 
 */  
public function _getFirstCharter($str){  
	 if(empty($str)){return '';} 
	 $fchar=ord($str{0}); 
	 if($fchar>=ord('A')&&$fchar<=ord('z')) return strtoupper($str{0}); 
	 $s1=iconv('UTF-8','gb2312',$str); 
	 $s2=iconv('gb2312','UTF-8',$s1); 
	 $s=$s2==$str?$s1:$str; 
	 $asc=ord($s{0})*256+ord($s{1})-65536; 
	 if($asc>=-20319&&$asc<=-20284) return 'A'; 
	 if($asc>=-20283&&$asc<=-19776) return 'B'; 
	 if($asc>=-19775&&$asc<=-19219) return 'C'; 
	 if($asc>=-19218&&$asc<=-18711) return 'D'; 
	 if($asc>=-18710&&$asc<=-18527) return 'E'; 
	 if($asc>=-18526&&$asc<=-18240) return 'F'; 
	 if($asc>=-18239&&$asc<=-17923) return 'G'; 
	 if($asc>=-17922&&$asc<=-17418) return 'H'; 
	 if($asc>=-17417&&$asc<=-16475) return 'J'; 
	 if($asc>=-16474&&$asc<=-16213) return 'K'; 
	 if($asc>=-16212&&$asc<=-15641) return 'L'; 
	 if($asc>=-15640&&$asc<=-15166) return 'M'; 
	 if($asc>=-15165&&$asc<=-14923) return 'N'; 
	 if($asc>=-14922&&$asc<=-14915) return 'O'; 
	 if($asc>=-14914&&$asc<=-14631) return 'P'; 
	 if($asc>=-14630&&$asc<=-14150) return 'Q'; 
	 if($asc>=-14149&&$asc<=-14091) return 'R'; 
	 if($asc>=-14090&&$asc<=-13319) return 'S'; 
	 if($asc>=-13318&&$asc<=-12839) return 'T'; 
	 if($asc>=-12838&&$asc<=-12557) return 'W'; 
	 if($asc>=-12556&&$asc<=-11848) return 'X'; 
	 if($asc>=-11847&&$asc<=-11056) return 'Y'; 
	 if($asc>=-11055&&$asc<=-10247) return 'Z'; 
	 return null;   
} 


}