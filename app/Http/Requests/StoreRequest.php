<?php

namespace App\Http\Requests;

use App\ArticleModel;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

//    public function addUser(){
////        $idInfo =
////        $_POST['id'];
//        $static = (new ArticleModel)->addUser($_POST);
//        return json_encode(array('static'=>$static));
////        return json_encode(array('static'=>$static));
//    }
}
