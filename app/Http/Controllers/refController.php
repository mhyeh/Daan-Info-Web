<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class refController extends Controller
{
    //
    public function index()// get ref/
    {
        //參考資料 頁面
        return view('ref');
    }
}
