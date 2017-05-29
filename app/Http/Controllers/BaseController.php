<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class BaseController extends Controller
{

    /**
     * 上传图片方法
     * @param Request $request
     * @return mixed
     */
    public function uploadPic(Request $request)
    {
        $file = $request->file('file');
        if (is_null($file)){
            $data =[
                'success'=>false,
                'errors'=>['请选择图片']
            ];
            return  Response::json($data);
        }
        $path = $file->store('','uploads');
        $data =[
            'success'=>true,
            'url'=>'/uploads/'.$path,
        ];
        return  Response::json($data);
    }
}
