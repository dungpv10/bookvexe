<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home(){
        return view('front-end.home.index');
    }

    public function getListBus(){
        return view('front-end.list-bus.bus');
    }
}
