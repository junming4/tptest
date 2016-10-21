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
    'SHOW_PAGE_TRACE' => true,  //输出右下方的查询条，必须是 $this->display();/才会有效果的

    //支付宝配置
    'AlipayConfig' => array(
        'partner' => '2088012027123802',//这里是你在成功申请支付宝接口后获取到的PID；
        'key' => 'ozvi5mcemm7lgkb11fmnyc9hckjvqtsn',//这里是你在成功申请支付宝接口后获取到的Key
        'sign_type' => strtoupper('MD5'),
        'input_charset' => strtolower('utf-8'),
        'cacert' => getcwd() . '\\cacert.pem',
        'transport' => 'http',
    ),
    'Alipay' => array(
        //这里是卖家的支付宝账号，也就是你申请接口时注册的支付宝账号
        'seller_email' => '2284876299@qq.com',
        //这里是异步通知页面url，提交到项目的Pay控制器的notifyurl方法；
        'notify_url' => 'http://tptest.io/index.php/Index/notifyurl',
        //这里是页面跳转通知url，提交到项目的Pay控制器的returnurl方法；
        'return_url' => 'http://tptest.io/index.php/Index/returnurl',
        //支付成功跳转到的页面，我这里跳转到项目的User控制器，myorder方法，并传参payed（已支付列表）
        'successpage' => '/Myaccount/topup/?ordtype=payed',
        //支付失败跳转到的页面，我这里跳转到项目的User控制器，myorder方法，并传参unpay（未支付列表）
        'errorpage' => 'XXx.com/XX/Xx?ordtype=unpay',
    )

);