<?php

namespace Api\Controller;



class IndexController extends ApiController  {
    public function index(){

        new  \Admin\Model\InfoModel();
        //$dom = new \('1.0', 'utf-8');

        //print_r($dom);exit;
        $result = array('code' => 0, 'data' => ['test','sjjsjsj'] );

        $this->ApiJson($result);
    }

    public function test(){
        $result = array('code' => 100, 'msg' => '请求成功！', 'data' => '' );
        $this->ApiJson($result);
    }
}