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
        $app->server->push(/**
         * @param $message
         * @return string
         */
            function($message){
               switch ($message['MsgType']) {
			        case 'event':
			            return '欢迎关注北京金松内蒙销售部公众账号！';
			            break;
			        case 'text':
			        	if ($message['Content'] == '删除') {
			        		$s = $this->del(0, $message);
			        		return $s;
			        	}
                        if ($message['Content'] == 'user') {
                            return $message['FromUserName'];
                        }
						$hello = explode(' ',$message['Content']); 
						if ($hello['0']=='查询') {
							$url ='http://wx.ay.lc/';
							$items = [new NewsItem([
							        'title'       => $hello['1'].'本周数据',
							        'description' => '...',
							        'url'         => $url,
							        'image'       => 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1516180354113&di=27d010e8a7143000f5033de19fec839a&imgtype=0&src=http%3A%2F%2Fimages1.gbicom.cn%2Fuploads%2Fueditor%2F20161227%2F1482808201873457.png']),];
							return new News($items);

						}elseif ($hello['0']=='删除') {
							$s = $this->del($hello['1'], $message);
			        		return $s;
						}

						if (count($hello) >= 3) {
							$a = $this->addtext($hello,$message);
                            return $a;
                        }
			            // return $message['Content'].'收到文字消息'.$abc;
			            break;
			        case 'image':
//			        	$content = $message['PicUrl'];
			        	$a = $this->addphoto($message);

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

    public function addphoto($data)
    {
    	// $data  = array();
    	// $data['PicUrl'] ='dddddddddddddd';
    	//写数据库，如果图片下载图片。   然后修改  内容 并修改图片
	    $sales = Sale::where(['state'=>0,  'userid'=> $data['FromUserName'],])->first();
        //查询图片md5 判断重复
        $md5 = md5_file($data['PicUrl']);
        $md5old = Sale::where('md5', $md5)->first();
        if ($md5old){
            if ($md5old->state){
                return "该图片已经上传过ID：".$md5old->id.'('.$md5old->mdname.$md5old->model.':'.$md5old->amount.')时间'.$md5old->date;
            }else{
                return "图片保存ok，请回复门店信息及型号价格，请用空格分开！";
            }
        }
        if (!$sales) {
            $id = DB::table('sales')->insertGetId(
                ['image' => $data['PicUrl'], 'md5'=>$md5, 'date'=>date('y-m-d',time()), 'userid'=>$data['FromUserName']]
            );
            if ($id) {
                return '图片保存ok，请回复门店信息及型号价格，请用空格分开！';
            }else{
                return '图片保存失败，请重新发送！';
            }

        }else{
            return '上一张图片还未设置门店信息，如重新发送请先回复 删除';
        }

	}
    public function addtext($data, $message)
    {
        $sales = Sale::where(['state'=>0, 'userid'=> $message['FromUserName'],])->first();
        if ($sales){
            //下载图片到本地，储存到想要目录并改名
            //url 远程图片地址
            //file 文件名称
            //path 保存路径
            $file = $data['1']."_".date('Y-m-d-his',time()).".jpg";
            $path = $data['0'];
            $url = $sales->image;
            $mendianid = Mendian::where('mdname',$data['0'])->first();
            if (!$mendianid){
                return "该门店不存在，请核对或添加新门店！";
            }
            $model = Mode::where('jmodel',$data['1'])->first();
            if (!$model){
                return "该型号不存在，请核对或联系管理添加！";
            }
            if (!is_numeric($data['2'])) {
                return '价格错误，请检查输入信息！';
            }
            if (!is_numeric($data['3'])) {
                return '状态信息错误，请检查输入信息！';
            }
            $quyu_id = $mendianid->quyu_id;
            $qudao_id = $mendianid->qudao_id;
            $price = $model->price;
            $newurl = $this->down($url,$file,$path);

            if ($newurl != false) {
                $luanjia = $data['3'] ?? 0;

                $id = DB::table('sales')
                    ->where('id', $sales->id)
                    ->update(['image'=>$newurl,'mdname' => $data['0'], 'quyu_id'=>$quyu_id, 'qudao_id'=>$qudao_id,'model' => $data['1'],'amount' => $data['2'],'state' => '1' ,'arbitrary' => $luanjia, 'price'=>$price,]);
                if ($id) {
                    return '数据添加成功,ID:'.$sales->id.'-'.$data['0'] .'-'.$data['1'];
                }else{
                    return '门店信息增加失败，从新发送门店信息！';
                }
            }else{
                return '图片下载失败';
            }
        }else{
            return '请先发票照片！';
        }
    }
    public function down($url,$file,$path)
    {
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
		$neri = '同利文化路 Q9H2F 2298';
        $hello = ['同利文化路', 'Q9H2F', '2298'];
        $a = $this->add($hello,'text');

		echo $a;
		// $qys =  Sale::where('state',0)->first();
		//   print_r($qys->id);
		//  foreach ($qys as $flight) {
		//     echo $flight->id;
		// }

	}



    public function del($id, $data)
    {
    	if ($id >0) {
    	    $url = DB::table('sales')->where('id','=',$id)->first();
	     	$ids = DB::table('sales')->where('id','=',$id)->delete();
	    	if ($ids) {
                Storage::disk('bms')->delete($url->image);  //然后在filesystem里设置 uploads在storage下的路径

                return '删除成功';
	    	}else{
	    		return '删除失败！';
	    	} 
    	}else{
            $url = DB::table('sales')->where('state','=',0)->first();
            $ids = DB::table('sales')->where('state','=',0)->delete();
	    	if ($ids) {
                Storage::disk('bms')->delete($url->image);  //然后在filesystem里设置 uploads在storage下的路径
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


    //价格检查  是否乱价
    public function checkprice()
    {

    }

}