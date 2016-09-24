<?php

namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index(){


        $result = array('name' => 'xiao');
        tag( 'test_init' , $result ) ;
        echo "sksksk";
       /* $user = M( 'User' );
        $data = $user->select();
        print_r($data);*/
    }
}