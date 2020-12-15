<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BabaController;

class BabaController extends Controller
{
    public function getUploadPage()
    {
        return view('upload', ['title' => '上传数据']);
    }
}
