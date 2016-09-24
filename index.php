<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');


//define('BIND_MODULE','Home');    //默认模块

//define('APP_STATUS','office'); 将会去加载【Application/Common/Conf/office.php】

// 定义存储类型和应用模式为SAE（ 用于支持SAE平台） [Sina App Engine（简称SAE）是新浪研发中心开发的国内首个公有云计算平台，是新浪云计算战略的核心组成部分，作为一个简单高效的分布式Web服务开发、运行平台越来越受开发者青睐。
//SAE环境和普通环境有所不同，它是一个分布式服务器集群，能让你的程序同时运行在多台服务器中。并提供了很多高效的分布式服务。SAE为了提升性能和安全，禁止了本地IO写操作，使用MemcacheX、Storage等存储型服务代替传统IO操作，效率比传统IO读写操作高，有效解决因IO瓶颈导致程序性能低下的问题。]
//define('STORAGE_TYPE','sae'); //【会去加载Conf/config_sae.php】

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);

// 定义应用目录
define('APP_PATH','./Application/');

// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单