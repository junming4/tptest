<?php
/**
 * Author: Little
 * EMAIL: xiaojm@mlxing.com
 * Date: 2016/9/20
 * DESC: 所有接口基础类
 */
namespace Api\Controller;

use Think\Controller;

class ApiController extends Controller
{
    /**
     * 对返回数据进行处理
     * @param array $result
     */
    protected function ApiJson(array $result)
    {

        $result['code']  = !isset($result['code']) ? 200 : $result['code'] ; //默认赋值给code
        if (strlen($result['msg']) < 1) {
            $result['msg'] = !empty(C('ApiCode.'.$result['code'])) ? C('ApiCode.'.$result['code']) : 'Success';
        }
        if (!is_array($result['data']) || empty($result['data']) || $result['data'] == array(array())) $result['data'] = array();

        if(I('request.callback')){ //如果有传callback则是【JSONP 格式】
            $this->ajaxReturn($result, 'JSONP');
        }
        $this->ajaxReturn($result, 'JSON');
    }
}

