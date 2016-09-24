<?php
/**
 * Desc:    别名映射,【避免多次使用命名控制，效率会比命名空间定位更高效】
 * @User:   Little (2284876299.com)
 * @Date:   2016/9/24
 * @Time:   23:29
 * @Version: 1.0
 */


//这些都是命名别名的方法
/*Think\Think::addMap('Think\Log',THINK_PATH.'Think\Log.php');
Think\Think::addMap('Org\Util\Array',THINK_PATH.'Org\Util\Array.php');

$map = array('Think\Log'=>THINK_PATH.'Think\Log.php','Org\Util\Array'=>THINK_PATH.'Org\Util\Array.php');
Think\Think::addMap($map);*/

return array(
    'Org\Util\Array' => THINK_PATH.'Org\Util\Array.php'
);