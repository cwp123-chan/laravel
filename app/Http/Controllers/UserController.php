<?php

namespace App\Http\Controllers;

use App\Flight as Flight;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $user = (new Flight)->index();
        return $user;
    }

    public function delUser($id){
        $status = (new Flight)->delUser($id);
        return json_encode(array('static'=>$status));
    }

    public function addUser(){

        $status = (new Flight)->addUser($_POST);
        return json_encode(array('static'=>$status));
//        return json_encode(array('static'=>$static));
    }
    public function editUser(){
        $status = (new Flight)->editUser($_POST);
        return $status;
    }
    public function showUser($num){
        $status = (new Flight)->showUser($num);
        return json_encode($status);
    }
}
