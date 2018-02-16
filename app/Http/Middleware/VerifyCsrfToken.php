<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * 这些 URI 将免受 CSRF 验证
     *
     * @var array
     */
    protected $except = [
        //
        'wxapi',
//        'wechat',
    ];

}


