<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UserModel extends Model
{
    protected $table = 'userinfo';
    public $timestamps = false;
    /**
    进行数据库操作 查询用户
     */
    public function index(){
//
        $users = UserModel::
           get();
        return $users;
    }
    public function showUser($num,$pageCount){
        $columns = UserModel::orderBy('id','desc')->paginate($perPage = $pageCount, $columns = ['*'], $pageName = '', $page = $num);
//        var_dump($columns->toArray()["data"]);
        $total = $columns->toArray()["total"];
//        向前台传入 用户总数 页码数 数据详情
        if($page == '0'){
            $page  = 1;
        }
        $user = [$columns->toArray()["data"],[$page],[$total]];
        // laravel 指代 $page 指代当前数据库查询到的页码的函数
        $allpage = ceil($total/$pageCount);
        if($allpage < $num){
//            如果查询时 数据库页码数小于前台传来的页码数 那就 强制令两者相等于数据库页码数
            $lastColumns = UserModel::paginate($perPage = $pageCount, $columns = ['*'], $pageName = '', $page = $allpage);
            //        向前台传入 用户总数 页码数 数据详情
            $lastUser = [$lastColumns->toArray()["data"],[$allpage],[$total]];
            return $lastUser;
        }
        return $user;
    }
    // 插叙排序

    function showUserOrder($num,$pageCount,$order){
        switch($order){
//            按时间排序 也就是按id大小自然排序
            case "1": $columns = UserModel::orderBy('id','desc')->paginate($perPage = $pageCount, $columns = ['*'], $pageName = '', $page = $num);break;
            case "2": $columns = UserModel::orderBy('id','asc')->paginate($perPage = $pageCount, $columns = ['*'], $pageName = '', $page = $num);break;
            case "3": $columns = UserModel::orderBy('age','asc')->paginate($perPage = $pageCount, $columns = ['*'], $pageName = '', $page = $num);break;
            case "4": $columns = UserModel::orderBy('age','desc')->paginate($perPage = $pageCount, $columns = ['*'], $pageName = '', $page = $num);break;
            default : $columns = UserModel::orderBy('id','desc')->paginate($perPage = $pageCount, $columns = ['*'], $pageName = '', $page = $num);break;
        }
        $total = $columns->toArray()["total"];
//        向前台传入 用户总数 页码数 数据详情
        if($page == '0'){
            $page  = 1;
        }
        $user = [$columns->toArray()["data"],[$page],[$total]];
        // laravel 指代 $page 指代当前数据库查询到的页码的函数
        $allpage = ceil($total/$pageCount);
        if($allpage < $num){
//            如果查询时 数据库页码数小于前台传来的页码数 那就 强制令两者相等于数据库页码数
            $lastColumns = UserModel::paginate($perPage = $pageCount, $columns = ['*'], $pageName = '', $page = $allpage);
            //        向前台传入 用户总数 页码数 数据详情
            $lastUser = [$lastColumns->toArray()["data"],[$allpage],[$total]];
            return $lastUser;
        }
        return $user;
    }


    // 进行删除用户操作
    public function delUser($id){
        $user = UserModel::find($id);
        $users = $user->delete();

        if($users == 'true'){
            $status = "true";
            return $status;
        }
    }

    public function addUser($id){
        $user = new UserModel;
        $user->name = $id['name'];
        $user->age = $id['age'];
        $user->save();
            $status = $user;
            return $status;
    }

    public function editUser($list){
        $user = UserModel::find($list['id']);
        $user->name = $list['name'];
        $user->age = $list['age'];
        $user->save();
            return $user;
    }

    // 进行查询任务
    public function searchUser($num,$pageCount,$order,$searchname = null,$searchage = null){
        if($searchname !== null && $searchage == null){
            switch($order){
                case "1":$columns = UserModel::orderBy('id','desc')->where("name","like","%$searchname%")->paginate($perPage = $pageCount, $columns = ['*'], $pageName = '', $page = $num);break;
                case "2":$columns = UserModel::orderBy('id','asc')->where("name","like","%$searchname%")->paginate($perPage = $pageCount, $columns = ['*'], $pageName = '', $page = $num);break;
                case "3":$columns = UserModel::orderBy('age','asc')->where("name","like","%$searchname%")->paginate($perPage = $pageCount, $columns = ['*'], $pageName = '', $page = $num);break;
                case "4":$columns = UserModel::orderBy('age','desc')->where("name","like","%$searchname%")->paginate($perPage = $pageCount, $columns = ['*'], $pageName = '', $page = $num);break;
                default:$columns = UserModel::orderBy('id','desc')->where("name","like","%$searchname%")->paginate($perPage = $pageCount, $columns = ['*'], $pageName = '', $page = $num);break;
            }
            if($page == '0'){
                $page  = 1;
            }
            //        var_dump($columns->toArray()["data"]);
            $total = $columns->toArray()["total"];
            $user = [$columns->toArray()["data"],[$page],[$total]];

            // laravel 指代 $page 指代当前数据库查询到的页码的函数
            $allpage = ceil($total/$pageCount);
//            var_dump($allpage);

            if($allpage < $num){
//            如果查询时 数据库页码数小于前台传来的页码数 那就 强制令两者相等于数据库页码数
                $lastColumns = UserModel::paginate($perPage = $pageCount, $columns = ['*'], $pageName = '', $page = $allpage);
                //        向前台传入 用户总数 页码数 数据详情
                $lastUser = [$lastColumns->toArray()["data"],[$allpage],[$total]];
                return $lastUser;
            }
            return $user;

        }else if ($searchname == null && $searchage !== null){
            switch($order){
                case "1":$columns = UserModel::orderBy('id','desc')->where("age","=","$searchage")->paginate($perPage = $pageCount, $columns = ['*'], $pageName = '', $page = $num);break;
                case "2":$columns = UserModel::orderBy('id','asc')->where("age","=","$searchage")->paginate($perPage = $pageCount, $columns = ['*'], $pageName = '', $page = $num);break;
                case "3":$columns = UserModel::orderBy('age','asc')->where("age","=","$searchage")->paginate($perPage = $pageCount, $columns = ['*'], $pageName = '', $page = $num);break;
                case "4":$columns = UserModel::orderBy('age','desc')->where("age","=","$searchage")->paginate($perPage = $pageCount, $columns = ['*'], $pageName = '', $page = $num);break;
                default:$columns = UserModel::orderBy('id','desc')->where("age","=","$searchage")->paginate($perPage = $pageCount, $columns = ['*'], $pageName = '', $page = $num);break;
            }
            if($page == '0'){
                $page  = 1;
            }
            //        var_dump($columns->toArray()["data"]);
            $total = $columns->toArray()["total"];
            $user = [$columns->toArray()["data"],[$page],[$total]];

            // laravel 指代 $page 指代当前数据库查询到的页码的函数
            $allpage = ceil($total/$pageCount);

            if($allpage < $num){
//            如果查询时 数据库页码数小于前台传来的页码数 那就 强制令两者相等于数据库页码数
                $lastColumns = UserModel::paginate($perPage = $pageCount, $columns = ['*'], $pageName = '', $page = $allpage);
                //        向前台传入 用户总数 页码数 数据详情
                $lastUser = [$lastColumns->toArray()["data"],[$allpage],[$total]];
                return $lastUser;
            }
            return $user;
//            var_dump($searchage);
        }else if ($searchname !== null && $searchage !== null){

            switch($order){
                case "1": $columns = UserModel::orderBy('id','desc')->where("age","=","$searchage")->where("name","like","%$searchname%")->paginate($perPage = $pageCount, $columns = ['*'], $pageName = '', $page = $num);break;
                case "2": $columns = UserModel::orderBy('id','asc')->where("age","=","$searchage")->where("name","like","%$searchname%")->paginate($perPage = $pageCount, $columns = ['*'], $pageName = '', $page = $num);break;
                case "3": $columns = UserModel::orderBy('age','asc')->where("age","=","$searchage")->where("name","like","%$searchname%")->paginate($perPage = $pageCount, $columns = ['*'], $pageName = '', $page = $num);break;
                case "4": $columns = UserModel::orderBy('age','desc')->where("age","=","$searchage")->where("name","like","%$searchname%")->paginate($perPage = $pageCount, $columns = ['*'], $pageName = '', $page = $num);break;
                default : $columns = UserModel::orderBy('id','desc')->where("age","=","$searchage")->where("name","like","%$searchname%")->paginate($perPage = $pageCount, $columns = ['*'], $pageName = '', $page = $num);break;

            }


            if($page == '0'){
                $page  = 1;
            }
            //        var_dump($columns->toArray()["data"]);
            $total = $columns->toArray()["total"];
            $user = [$columns->toArray()["data"],[$page],[$total]];

            // laravel 指代 $page 指代当前数据库查询到的页码的函数
            $allpage = ceil($total/$pageCount);

            if($allpage < $num){
//            如果查询时 数据库页码数小于前台传来的页码数 那就 强制令两者相等于数据库页码数
                $lastColumns = UserModel::paginate($perPage = $pageCount, $columns = ['*'], $pageName = '', $page = $allpage);
                //        向前台传入 用户总数 页码数 数据详情
                $lastUser = [$lastColumns->toArray()["data"],[$allpage],[$total]];
                return $lastUser;
            }
            return $user;
        }
    }
}
