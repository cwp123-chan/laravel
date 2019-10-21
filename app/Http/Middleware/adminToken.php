<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;

class adminToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        session_start();
//        var_dump($_SESSION);
        $session = $_SESSION;
        if(empty($session)){
//            如果没有数据 则跳转 登录页
//            并将错误信息闪存
            return redirect('/login')->with("tokenmsg","用户身份已过期,请重新登录");
        }else{
            return $next($request);
        }


    }
}
