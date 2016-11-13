<?php
/**
 * @User:   Little (2284876299.com)
 * @Date:   2016/11/13
 * @Time:   22:06
 * @Version: 1.0
 * Desc:  秒杀系统操作控制器
 */

namespace Home\Controller;

use Common\Model\SecKillCacheModel;
use Think\Controller;
use Think\Model;

class GoodsController extends Controller
{
    /**
     * 展示秒杀产品
     * @return bool
     */
    public function info()
    {
        //对数据进行缓存
        $id = (int)$_POST['id'];
        if ($id < 1) return false;
        $secKillObj = new SecKillCacheModel();
        $info = $secKillObj->getSecKInfo($id);
        if (empty($info)) { //执行数据库操作
            $info = array('name' => '秒杀iphone7', 'id' => 100);
            if (!empty($info)) {
                $secKillObj->putSecKInfo($info);
            }
        }
        if (is_array($info)) $info = array();
        return $info;
    }

    /**
     * 更新库存优化 【伪代码】
     * @return bool
     */
    public function updateSecKillInfo()
    {
        $id = 1;
        $user_id = 1;

        $modelObj = new  Model();
        $modelObj->startTrans();
        //1、先执行插入【这样可以减少gc网络延迟】
        //user_id 和id使用了唯一索引
        $sql_str = "INSERT INTO IGNORE seckill_table (`info`,`id`,`user_id`) VALUE ('内容'，$id,$user_id)";
        $id = mysqli_execute($sql_str);
        if ($id < 1) return false;  //这里一般可以减少秒杀gc


        $sql_update_str = "UPDATE Person SET num=num-1 where id=$id AND num>0";

        //秒杀不成功回滚
        if (!mysqli_execute($sql_update_str)) {
            //事务回滚
            $modelObj->rollback();
            return false;
        }
        //秒杀成功回滚
        $modelObj->commit();

        //优化使用存储过程进行优化
    }

}

