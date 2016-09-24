<?php

namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index(){
        $user = D('Home/User');
        $data = $user->select();
        print_r($data);
    }
}