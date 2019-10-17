<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Flight extends Model
{
    protected $table = 'userinfo';
    public $timestamps = false;
    /**
    进行数据库操作 查询用户
     */
    public function index(){
//
        $flights = Flight::
           get();
        return $flights;
    }
    public function showUser($num){
        $limit = $num*5;
        $flights = Flight::
            offset($limit)
            ->take(5)
           ->get();
        return $flights;
    }
    // 进行删除用户操作
    public function delUser($id){
//
        $flight = Flight::find($id);
        $flights = $flight->delete();

        if($flights == 'true'){
            $status = "true";
            return $status;
        }
    }

    public function addUser($id){
//        $id['name'];
        $flight = new Flight;
        $flight->name = $id['name'];
        $flight->age = $id['age'];
        $flight->save();
//        if($flight == "true"){
            $status = "true";
            return $status;
//        }
    }

    public function editUser($list){
        $flight = Flight::find($list['id']);
        $flight->name = $list['name'];
        $flight->age = $list['age'];
        $flight->save();
            return $flight;
    }
}
