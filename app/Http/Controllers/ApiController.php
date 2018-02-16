<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Log::info('日志',$request->all());

        return 'ok';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function wxuser()
    {
        Cache::forget('users');//删除缓存数据

        $data = file_get_contents('http://127.0.0.1:3000/openwx/get_friend_info');
//        echo($data);
//        return $data;
        $arr = json_decode($data,true);
        $url = 'http://127.0.0.1:3000/openwx/send_friend_message';
        foreach ($arr as $user)
        {
            if ($user['category'] =='好友'){
                $user['state'] = 0;
                $users[] = $user;
            }
        }

        Cache::forever('users',$users);
        $value = Cache::get('users');
        echo '<pre>';
        var_dump($value);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
//        $data = file_get_contents('http://127.0.0.1:3000/openwx/get_friend_info');
////        echo($data);
////        return $data;
//        $arr = json_decode($data,true);
        $url = 'http://127.0.0.1:3000/openwx/send_friend_message';
        $value = Cache::get('users');
        foreach ($value as $wx)
        {
//            dd($wx['name']);
            if ($wx['category'] =='好友' || $wx['state'] ==0){
//                echo($wx['id']);
//                echo '<br>';
                $post_data = [
                    'content'=>'[發][發][發][發]  今天是大年三十了 ，祝福朋友！🎀🎀新年快乐🎀🎀 开开心心[耶][耶][耶][耶]  感恩大家一直以来的支持😁
┏╮/╱¸.•*""*•.¸
  💛    新年事事顺利💛
╱/╰┛¸.新年天天，好心情💛          
✿祝福朋友们👉✪✿
┊　 ┊　 ┊  開心順利¸.•*¨`*•🐳
┊　 ┊　好運連連¸.•*¨`*• 🐳
┊　幸福滿滿¸.•*¨`*• 🐳 
闔家安康¸.•*¨`*•🐳
__ *🐼*🐼*真摯*🐼*🐼*
_*🐼****🐼願您🐼****🐼*
*🐼*_吉祥_*⭐*_ 如意_*🐼*
*🐼* ___ 平安  健康  ___*🐼*
_*🐼*__  順心 愉悅 __ *🐼*
__ *🐼*幸福  __ 美滿*🐼*
__ ___*🐼*好運到*🐼*
________*🐼*   *🐼*
   祝福您及家人*🐼*  🍀🌺🍒*¯`•.¸✲☆ 
┊　┊☆淡淡的牽掛🍒*¯`•✲☆
┊　┊☆深深的祝福🍒*¯`✲☆
┊　┊☆淺淺的微笑🍒*.✲☆*
┊　┊☆滿滿的喜悅🍒☆ *
┊　┊　┊　┊　💛
┊　┊　┊　💛  
┊　┊　💛
┊　💛
💛财运滚滚来。🎉🎉🎉🎉',
                    'id'=>$wx['id'],
                    ];
                $this->curlGet($url, 'post', $post_data);
            }
//            echo $wx['name'];
            sleep(10);
        }
//输出
        echo '<pre>';
//        dd($arr);

    }


    /**
     * @param $url
     * @param $method
     * @param int $post_data
     * @return mixed
     */
    public function curlGet($url,$method,$post_data = 0){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if ($method == 'post') {
            curl_setopt($ch, CURLOPT_POST, 1);

            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        }elseif($method == 'get'){
            curl_setopt($ch, CURLOPT_HEADER, 0);
        }
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
