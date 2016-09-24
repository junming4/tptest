<?php
return array(
	//'配置项'=>'配置值'
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'tptest',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'tp_',    // 数据库表前缀

    //设置禁止访问的模块列表
    'MODULE_DENY_LIST' => array('Common','Runtime'),
    //只能访问这些模块
    'MODULE_ALLOW_LIST' => array('Home','Admin','Api'),
    'DEFAULT_MODULE' => 'Home',  //默认访问模块

);