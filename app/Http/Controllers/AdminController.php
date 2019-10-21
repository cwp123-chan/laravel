<?php

namespace App\Http\Controllers;

use App\admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * 存储用户的保密信息。
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function storeSecret(Request $request)
    {
        $rePwd = $request->adminPwd;
        $reName = $request->adminName;

        $pwd =encrypt($rePwd);
//        var_dump($pwd);
        $name = $reName;
//        return $name;
        $admin = new admin;
        $adminStatus = $admin->addAdmin($pwd,$name);
        return $adminStatus;
    }

//    查询登录
    public function tologin(Request $request){
        $name = $request->admin;
        $pwd = $request->pwd;
        $admin = new admin;
        $adminStatus = $admin->showAdmin($name);
        $repwd = decrypt($adminStatus);
        if($pwd === $repwd){
            $this->setToken($name);
            return 'true';
        }

    }
    public function setToken($name){
        session_start();
        $_SESSION['name'] = $name;
    }
    public function out(){
        // 初始化session.
        session_start();
        /*** 删除所有的session变量..也可用unset($_SESSION[xxx])逐个删除。****/
        $_SESSION['name'] = "";
        // 最后彻底销毁session.
        session_destroy();
        return 'true';
    }

}
