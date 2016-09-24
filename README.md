## 简介
##该项目使用thinkphp 3.2.3 版本
    该项目分为
    -Admin 后台模块
    -Home  前端模块
    -Api   接口模块
## 重点配置部分
    define('APP_STATUS','office'); 将会去加载【Application/Common/Conf/office.php】

##完整的架构目录应该像 Application\admin 一样
    -Conf 配置文件
    -Controller 控制器文件
    -Event 事件触发文件，继承于控制controller 方便触发事件可以全部都在这里使用
    -Logic 逻辑层，处理一些文件逻辑关系的文件，继承于Model
    -Service 服务层文件，处理一些服务文件的数据，继承于Model

## 疑难杂症
    -tag('my_tag'); // 添加my_tag 标签侦听
    -【my_tag】 可以为以下字段
    -app_init 应用初始化标签位
    -module_check 模块检测标签位（3.2.1版本新增）
    -path_info PATH_INFO检测标签位
    -app_begin 应用开始标签位
    -action_name 操作方法名标签位
    -action_begin 控制器开始标签位
    -view_begin 视图输出开始标签位
    -view_template 视图模板解析标签位
    -view_parse 视图解析标签位
    -template_filter 模板解析过滤标签位
    -view_filter 视图输出过滤标签位
    -view_end 视图输出结束标签位
    -action_end 控制器结束标签位
    -app_end 应用结束标签位

    -【输出右下方的查询条】'SHOW_PAGE_TRACE' => true  //输出右下方的查询条，必须是 $this->display();/才会有效果的
    
    -【添加标签触发,由于无法找到类测试无法完成】1）、在所在的开发目录添加一个文件夹叫 Behavior并在下面创建文件为UserBehavior.php
    -2）、创建一个文件在conf中叫 tag.php 和添加 一条数据  return array( 'test_init' => array( 'Admin\Behavior\UserBehavior' );
    -3）、tag( 'test_init' ,'testtsss' ) 
    
    
## 未解决的问题
    -不知道为什么 thinkphp3.2.3 和3.2.2 php 版本为 5.6
    使用 new User();都会报找不到class