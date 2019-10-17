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
            return 'true';
        }

    }
}
