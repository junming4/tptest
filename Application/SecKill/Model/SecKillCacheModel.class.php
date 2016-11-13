<?php
/**
 * @User:   Little (2284876299.com)
 * @Date:   2016/11/13
 * @Time:   22:10
 * @Version: 1.0
 * Desc:缓存操作类【todo 这里是伪代码，无法运行的】
 */

namespace Common\Model;

use Think\Cache\Driver\Redis;

class SecKillCacheModel
{
    protected $redisObj = null;

    /**
     * 秒杀key前缀
     * @var string
     */
    private static $KEY_FOR_SECKill_KEY = 'ca5411a6363fef8bb36108e10dabb847';

    public function __construct()
    {
        $this->redisObj = new Redis();
    }


    /**
     * 获取秒杀数据
     * @param $secKillId
     * @return array|bool|mixed
     */
    public function getSecKInfo($secKillId)
    {
        $secKillId = (int)$secKillId;
        if ($secKillId < 1) return false;
        $keys = self::$KEY_FOR_SECKill_KEY . '_' . $secKillId;
        //进行缓存[redis|memcache 等等]
        $info = $this->redisObj->get($keys);

        if (empty($info) || !is_array($info)) {
            return false;
        }
        return $info;

    }

    /**
     * 缓存秒杀数据
     * @param $secKillInfo
     * @return bool
     */
    public function putSecKInfo($secKillInfo)
    {
        if (empty($secKillInfo)) return false;
        $secKillId = (int)$secKillInfo['id'];
        if ($secKillId < 1) return false;
        $keys = self::$KEY_FOR_SECKill_KEY . '_' . $secKillId;
        return $this->redisObj->set($keys, $secKillInfo, 60 * 60);
    }

}