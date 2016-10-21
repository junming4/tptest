<?php
/**
 * Desc:
 * @User:   Little (2284876299.com)
 * @Date:   2016/10/17
 * @Time:   21:11
 * @Version: 1.0
 */

namespace Home\Model;

use Think\Log;

vendor('WxPayAPI.WxPayConfig');
vendor('WxPayAPI.WxPayException');
vendor('WxPayAPI.WxPayData');
vendor('WxPayAPI.WxPayApi');
vendor('WxPayAPI.WxPayNotify');
vendor('WxPayAPI.WxPayNativePay');

class WxNotifyModel extends \WxPayNotify
{
    public function NotifyProcess($data, &$msg)
    {

        Log::write(json_encode($data) . '||msg=>' . $msg);
        if (!array_key_exists("openid", $data) ||
            !array_key_exists("product_id", $data)
        ) {
            $msg = "回调数据异常";
            return false;
        }

        $openid = $data["openid"];
        $product_id = $data["product_id"];

        //统一下单
        $result = $this->unifiedorder($openid, $product_id);
        if (!array_key_exists("appid", $result) ||
            !array_key_exists("mch_id", $result) ||
            !array_key_exists("prepay_id", $result)
        ) {
            $msg = "统一下单失败";
            return false;
        }

        $this->SetData("appid", $result["appid"]);
        $this->SetData("mch_id", $result["mch_id"]);
        $this->SetData("nonce_str", WxPayApi::getNonceStr());
        $this->SetData("prepay_id", $result["prepay_id"]);
        $this->SetData("result_code", "SUCCESS");
        $this->SetData("err_code_des", "OK");
        return true;
    }
}