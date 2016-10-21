## 把我的项目提交到github 中git remote add origin https://github.com/junming4/tptest.git
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
    
    -【添加标签触发】1）、在所在的开发目录添加一个文件夹叫 Behavior并在下面创建文件为UserBehavior.class.php
    -2）、创建一个文件在conf中叫 tag.php 和添加 一条数据  return array( 'test_init' => array( 'Admin\Behavior\UserBehavior' );
    -3）、tag( 'test_init' ,'testtsss' ) 
    
## 控制器部分
    -'ACTION_SUFFIX' => 'Action', // 操作方法后缀  加上这一句的话，本来 index()将需要变成 indexAction();
    
    - 调用控制器层使用A函数 ，A('User') ||  A('User','Event');
    
    
## 未解决的问题
    -不知道为什么 thinkphp3.2.3 和3.2.2 php 版本为 5.6
    使用 new User();都会报找不到class【问题已经解决了，命名不规范xxx.class.php才对的】 2016/09/24
    
## 加载第三方内库的方法
    -导入Org类库包 Library/Org/Util/Date.class.php类库
    -import("Org.Util.Date");
    - 44 -对于import方法，系统会自动识别导入类库文件的位置，ThinkPHP可以自动识别的类库包包括Think、
    -Org、Com、Behavior和Vendor包，以及Library目录下面的子目录，如果你在Library目录下面创建了
    -一个Test子目录，并且创建了一个UserTest.class.php类库，那么可以这样导入：
    -其他的就认为是应用类库导入。
    -注意，如果你的类库没有使用命名空间定义的话，实例化的时候需要加上根命名空间，例如：
    -按照系统的规则，import方法是无法导入具有点号的类库文件的，因为点号会直接转化成斜线，例如我们
    -定义了一个名称为User.Info.class.php 的文件的话，采用：
    -方式加载的话就会出现错误，导致加载的文件不是Org/User.Info.class.php 文件，而是
    -Org/User/Info.class.php 文件，这种情况下，我们可以使用：
    -来导入。
    -大多数情况下，import方法都能够自动识别导入类库文件的位置，如果是特殊情况的导入，需要指定
    -import方法的第二个参数作为起始导入路径。例如，要导入当前文件所在目录下面的
    -RBAC/AccessDecisionManager.class.php 文件，可以使用：
    -如果你要导入的类库文件名的后缀不是class.php而是php，那么可以使用import方法的第三个参数指定
    -后缀：
    -// 导入Home模块下面的 Application/Home/Util/UserUtil.class.php类库
    -import("Home.Util.UserUtil");
    -// 导入当前模块下面的类库
    -import("@.Util.Array");
    -// 导入Vendor类库包 Library/Vendor/Zend/Server.class.php
    -import('Vendor.Zend.Server');
    
##  魔术方法
   - function __set() 设置类参数不存在的时候就会自动调用 $test->title='hh';//如果title不存在
   - function __get() 获取类参数不存在的时候就会自动调用 echo $test->title;//如果title不存在
   - function __call() 调用类方法不存在的时候就会自动调用  $test->happy('test'); //如果happy函数不存在
   - function __callStatic() 调用类[静态]方法不存在的时候就会自动调用  Test::happy('test');  //如果happy函数不存在
   - function __toString()  当对象以字符串出现的时候自动调用  echo $test;
   - function __invoke() 当一个对象当成函数去调用的时候自动调用  $test("geooo"); 
   
##  php Spl的几种数据结构
   
       - 1、spl 栈数据结构
       - $splStack = new \SplStack(); //栈数据结构【先进后出】
       - $splStack->push("push1\n");
       - $splStack->push("push2\n");
       - echo $splStack->pop();
       - echo "<br/>";
       - echo $splStack->pop();
   
       - 2、spl 队列数据结构 【先进先出，后进后出】
       - $splQueue = new \SplQueue();
       - $splQueue->enqueue("push1");
       - $splQueue->enqueue("push2");
       - echo $splQueue->dequeue();
       - echo "<br/>";
       - echo $splQueue->dequeue();
   
       - 3、spl 堆数据结构
       - $splMinHeap = new \SplMinHeap();
       - $splMinHeap->insert("splMinHeap1\n");
       - $splMinHeap->insert("splMinHeap2\n");
       - echo $splMinHeap->extract();
       - echo "<br/>";
       - echo $splMinHeap->extract();
   
       - 4、固定长度的数组
       - $splFixedArray = new \SplFixedArray(10);
       - $splFixedArray[0] = 'xiaojunming';
       - $splFixedArray[5] = '哈哈';
       - print_r($splFixedArray);
   
## php模式
   - 1、工厂模式 ： 不用 new来实例化对象【修改配置简单】
       namespace Home\Factory;
       class Factory{
            static function createDatabase(){
                $db = new DataBase();
                return $db;
            }
       }
       $db = \Home\Factory::createDatabase();
   - 2、单列模式 : 一个对象只实例化一次
        namespace Home\DataBase;
        class DataBase{
            private static $db;
            private function __construct(){}
            static function getInstance(){
                if( self::$db instanceof self ) self::$db = new self;
                return self::$db;
            }
        }
       - 工厂模式+单列模式
       namespace Home\Factory;
       class Factory{
            static function createDatabase(){
                $db = Home\DataBase::getInstance();
                return $db;
            }
       }
   - 3、注册模式 ：  全局共享和交换对象
   
   - 4、适配模式 ： 可以将截然不同的函数接口封装成统一的api,【可以使用接口继承方式或者继承超像类方式来实现，TP中Cache、Cache、Log等都有用到了适配模式了】
   
   - 5、策略模式 ： 将一组特定的行为和算法封装成类，以适应某些特定的上下文环境，这种模式就是策略模式。
  
   ## git 其他命令部分
    - 返回版本
    git log 
    git reset --hard 版本号
   
    