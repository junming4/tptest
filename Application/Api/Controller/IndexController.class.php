<?php

namespace Api\Controller;


class IndexController extends ApiController  {
    public function index(){
        $result = array('code' => 0, 'data' => ['test','sjjsjsj'] );

        $this->ApiJson($result);
    }

    public function test(){
        $result = array('code' => 100, 'msg' => '请求成功！', 'data' => '' );
        $this->ApiJson($result);
    }
}