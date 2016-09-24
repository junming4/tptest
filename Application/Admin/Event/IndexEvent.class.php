<?php
/**
 * Desc:    首页数据触发
 * @User:   Little (2284876299.com)
 * @Date:   2016/9/25
 * @Time:   0:25
 * @Version: 1.0
 */

namespace Admin\Event;

use Think\Controller;

class IndexEvent extends Controller {
    public function index(){
        $result = array('name' => 'xiao');
        tag( 'test_init' , $result ) ;
    }
}