<?php
/**
 * Desc:    用户行为定义
 * @User:   Little (2284876299.com)
 * @Date:   2016/9/24
 * @Time:   19:01
 * @Version: 1.0
 */

namespace Admin\Behavior;

class UserBehavior
{
    public function run(&$params)
    {
        if (C('TEST_PARAM')) {
            echo 'RUNTEST BEHAVIOR ' . $params;
        }
    }
}