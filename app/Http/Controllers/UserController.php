<?php

namespace App\Http\Controllers;

use App\UserModel as UserModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class UserController extends Controller
{

    public function index(){
//        $user = (new UserModel)->index();
        return view('admin.app');
    }

    public function delUser($id){
        $status = (new UserModel)->delUser($id);
        return json_encode(array('static'=>$status));
    }

    public function addUser(){
        if (empty($_POST['id'])){
            $status = (new UserModel)->addUser($_POST);
//            var_dump($_POST);
            return json_encode(array('static'=>$status));
        }else{
            $this->editUser();
        }
    }
    public function editUser(){
        $url = URL::current();
        $status = (new UserModel)->editUser($_POST);
        $data = [
            $url,
            $status
        ];
        $data = json_encode($data);
        print_r($data);
        return $data;

    }
    public function showUser(Request $request){
//        如果 排序不为空
//        那么 就按照排序方法来
        if(!empty($request->order)){
            $pageCount = $request->pageCount;
            $status = (new UserModel)->showUserOrder($request->num,$pageCount,$request->order);
            return json_encode($status);
        }else{
            $pageCount = $request->pageCount;
            $status = (new UserModel)->showUser($request->num,$pageCount);
            return json_encode($status);
        }
    }
    public function searchUser(Request $request){
        if(!empty($request->order)){
//            做搜索分页
            $num = $request->num;
            $pageCount = $request->pageCount;
            if($request->searchname !== null && $request->searchage == null){
                print_r("我是搜索分页",$request->order);
                $searchname = $request->searchname;
                $searchUser = (new UserModel)->searchUser($num,$pageCount,$request->order,$searchname);
                return $searchUser;
                //            var_dump($searchUser);
            }else if ($request->searchname == null && $request->searchage !== null){
                $searchage = $request->searchage;
                $searchUser = (new UserModel)->searchUser($num,$pageCount,$request->order,$searchage);
                return $searchUser;
            }else if ($request->searchname !== null && $request->searchage !== null){
                $searchage = $request->searchage;
                $searchname = $request->searchname;
                $searchUser = (new UserModel)->searchUser($num,$pageCount,$request->order,$searchname,$searchage);
                return $searchUser;
                //            var_dump($request->searchage,$request->searchname);
            }else{
                $pageCount = $request->pageCount;
                $status = (new UserModel)->showUser($request->num,$pageCount);
                return json_encode($status);
            }
        }else{
//            var_dump($request->num);

            $order = 0;
            $num = $request->num;
            $pageCount = $request->pageCount;
            if($request->searchname !== null && $request->searchage == null){
                $searchname = $request->searchname;
                $searchUser = (new UserModel)->searchUser($num,$pageCount,$order,$searchname);
                return $searchUser;
    //            var_dump($searchUser);
            }else if ($request->searchname == null && $request->searchage !== null){
                $searchage = $request->searchage;
                $searchUser = (new UserModel)->searchUser($num,$pageCount,null,$searchage);
                return $searchUser;
            }else if ($request->searchname !== null && $request->searchage !== null){
                $searchage = $request->searchage;
                $searchname = $request->searchname;
                $searchUser = (new UserModel)->searchUser($num,$pageCount,null,$searchname,$searchage);
                return $searchUser;
    //            var_dump($request->searchage,$request->searchname);
            }else{

                $pageCount = $request->pageCount;
                $status = (new UserModel)->showUser($request->num,$pageCount);
                return json_encode($status);
            }
        }


    }
}
