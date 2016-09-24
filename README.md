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