<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    //
    public function addAdmin($pwd,$name){
//        var_dump($pwd,$name);
//        因为 一开始使用orm模型的时候 admin.php文件已经与数据库产生联系了
        $admin = new admin;

        $admin->name = $name;
        $admin->password = $pwd;

        $status = $admin->save();
        if($status == 'true'){
            return '1';
        }else{
            return '0';
        }

    }

    public function showAdmin($name){
        $admin = admin::
            where('name', $name)
            ->get();
        foreach($admin as $v){
            $pwd = $v->password;
            if($pwd != null){
            return $pwd;
            }else{
                return $pwd;
            }
        }
//
//
//        return $flights;
    }
}
