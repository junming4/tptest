<?php

namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index(){

        M( 'Info' );
       /* $user = M( 'User' );
        $data = $user->select();
        print_r($data);*/
    }
}