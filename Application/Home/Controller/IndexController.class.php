<?php

namespace Home\Controller;

use Home\Model\WxNotifyModel;
use Think\Controller;
use Think\Log;

class IndexController extends Controller
{
    private function _importWxHelper(){
        vendor('WxPayAPI.WxPayConfig');
        vendor('WxPayAPI.WxPayException');
        vendor('WxPayAPI.WxPayData');
        vendor('WxPayAPI.WxPayApi');
        vendor('WxPayAPI.WxPayNotify');
        vendor('WxPayAPI.WxPayNativePay');
    }

    private function _importWxApi(){
        vendor('WxPayPubHelper.WxPayPubHelper');
    }

    /**
     *支付说明
     */
    public function wxPay(){

        $this->_importWxHelper();
        $notify = new \NativePay();

        $input = new \WxPayUnifiedOrder();
        $input->SetBody("test");
        $input->SetAttach("test");
        $input->SetOut_trade_no(\WxPayConfig::MCHID.date("YmdHis"));
        $input->SetTotal_fee("1");
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("test");
        $input->SetNotify_url("http://tptest.io/index.php/Index/wxNotify");
        $input->SetTrade_type("NATIVE");
        $input->SetProduct_id("123456789");

        //获取统一支付接口结果
        $unifiedOrderResult = $notify->GetPayUrl($input);

        //商户根据实际情况设置相应的处理流程
        if ($unifiedOrderResult["return_code"] == "FAIL")
        {
            //商户自行增加处理流程
            echo "通信出错：".$unifiedOrderResult['return_msg']."<br>";
        }
        elseif($unifiedOrderResult["result_code"] == "FAIL")
        {
            //商户自行增加处理流程
            echo "错误代码：".$unifiedOrderResult['err_code']."<br>";
            echo "错误代码描述：".$unifiedOrderResult['err_code_des']."<br>";
        }
        elseif($unifiedOrderResult["code_url"] != NULL)
        {
            //从统一支付接口获取到code_url
            $code_url = $unifiedOrderResult["code_url"];
            //商户自行增加处理流程
            //......
        }
        $this->assign('out_trade_no',\WxPayConfig::MCHID.date("YmdHis"));
        $this->assign('code_url',$code_url);
        $this->assign('unifiedOrderResult',$unifiedOrderResult);

        $this->display();
    }

    public function wxNotify(){
        Log::write("begin notify!");

        $notify = new WxNotifyModel();

        $notify->Handle(true);
    }


    public function wxPay_V2(){
        $this->_importWxApi();

       /* $input = new WxPayUnifiedOrder();
        $input->SetBody("test");
        $input->SetAttach("test");
        $input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
        $input->SetTotal_fee("1");
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("test");
        $input->SetNotify_url("http://paysdk.weixin.qq.com/example/notify.php");
        $input->SetTrade_type("NATIVE");
        $input->SetProduct_id("123456789");
        $result = $notify->GetPayUrl($input);
        $url2 = $result["code_url"];*/

        //使用统一支付接口
        $unifiedOrder = new \UnifiedOrder_pub();

        //设置统一支付接口参数
        //设置必填参数
        //appid已填,商户无需重复填写
        //mch_id已填,商户无需重复填写
        //noncestr已填,商户无需重复填写
        //spbill_create_ip已填,商户无需重复填写
        //sign已填,商户无需重复填写
        $unifiedOrder->setParameter("body","贡献一分钱");//商品描述
        //自定义订单号，此处仅作举例
        $timeStamp = time();
        $out_trade_no = C('WxPayConf_pub.APPID')."$timeStamp";
        $unifiedOrder->setParameter("out_trade_no","$out_trade_no");//商户订单号
        $unifiedOrder->setParameter("total_fee","1");//总金额
        $unifiedOrder->setParameter("notify_url", \WxPayConf_pub::NOTIFY_URL);//通知地址
        $unifiedOrder->setParameter("trade_type","NATIVE");//交易类型
        //非必填参数，商户可根据实际情况选填
        //$unifiedOrder->setParameter("sub_mch_id","XXXX");//子商户号
        //$unifiedOrder->setParameter("device_info","XXXX");//设备号
        //$unifiedOrder->setParameter("attach","XXXX");//附加数据
        //$unifiedOrder->setParameter("time_start","XXXX");//交易起始时间
        //$unifiedOrder->setParameter("time_expire","XXXX");//交易结束时间
        //$unifiedOrder->setParameter("goods_tag","XXXX");//商品标记
        //$unifiedOrder->setParameter("openid","XXXX");//用户标识
        //$unifiedOrder->setParameter("product_id","XXXX");//商品ID

        //获取统一支付接口结果
        $unifiedOrderResult = $unifiedOrder->getResult();

        //商户根据实际情况设置相应的处理流程
        if ($unifiedOrderResult["return_code"] == "FAIL")
        {
            //商户自行增加处理流程
            echo "通信出错：".$unifiedOrderResult['return_msg']."<br>";
        }
        elseif($unifiedOrderResult["result_code"] == "FAIL")
        {
            //商户自行增加处理流程
            echo "错误代码：".$unifiedOrderResult['err_code']."<br>";
            echo "错误代码描述：".$unifiedOrderResult['err_code_des']."<br>";
        }
        elseif($unifiedOrderResult["code_url"] != NULL)
        {
            //从统一支付接口获取到code_url
            $code_url = $unifiedOrderResult["code_url"];
            //商户自行增加处理流程
            //......
        }
        $this->assign('out_trade_no',$out_trade_no);
        $this->assign('code_url',$code_url);
        $this->assign('unifiedOrderResult',$unifiedOrderResult);

        $this->display();
    }


    public function qrcode(){
        vendor('WxPayPubHelper.PhpQrCode');
        $url = urldecode($_GET["data"]);

        \ORcode::png($url);
    }


    public function notify()
    {
        //使用通用通知接口
        $notify = new \Notify_pub();

        //存储微信的回调
        $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
        $notify->saveData($xml);

        //验证签名，并回应微信。
        //对后台通知交互时，如果微信收到商户的应答不是成功或超时，微信认为通知失败，
        //微信会通过一定的策略（如30分钟共8次）定期重新发起通知，
        //尽可能提高通知的成功率，但微信不保证通知最终能成功。
        if($notify->checkSign() == FALSE){
            $notify->setReturnParameter("return_code","FAIL");//返回状态码
            $notify->setReturnParameter("return_msg","签名失败");//返回信息
        }else{
            $notify->setReturnParameter("return_code","SUCCESS");//设置返回码
        }
        $returnXml = $notify->returnXml();
        echo $returnXml;

        //==商户根据实际情况设置相应的处理流程，此处仅作举例=======

        //以log文件形式记录回调信息
        //         $log_ = new Log_();
        $log_name= __ROOT__."/Public/notify_url.log";//log文件路径

        $this->log_result($log_name,"【接收到的notify通知】:\n".$xml."\n");

        if($notify->checkSign() == TRUE)
        {
            if ($notify->data["return_code"] == "FAIL") {
                //此处应该更新一下订单状态，商户自行增删操作
                log_result($log_name,"【通信出错】:\n".$xml."\n");
            }
            elseif($notify->data["result_code"] == "FAIL"){
                //此处应该更新一下订单状态，商户自行增删操作
                log_result($log_name,"【业务出错】:\n".$xml."\n");
            }
            else{
                //此处应该更新一下订单状态，商户自行增删操作
                log_result($log_name,"【支付成功】:\n".$xml."\n");
            }

            //商户自行增加处理流程,
            //例如：更新订单状态
            //例如：数据库操作
            //例如：推送支付完成信息
        }
    }


    ##########################扫码微信支付##################################
    public function index(){
        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }

    public function _ImportAlipy(){
        vendor('Alipay.AlipayFunction');
        vendor('Alipay.AlipayMd5Function');
        vendor('Alipay.AlipayNotify');
        vendor('Alipay.AlipaySubmit');
    }


    /**
     * 支付
     */
    public function doalipay()
    {
        $this->_ImportAlipy();

        $alipayConfig = C('AlipayConfig');

        //生成订单号
        $trade_no = '20161011114558';
        /**************************请求参数**************************/
        $payment_type = "1"; //支付类型 //必填，不能修改
        $notify_url = C('Alipay.notify_url'); //服务器异步通知页面路径
        $return_url = C('Alipay.return_url'); //页面跳转同步通知页面路径
        $seller_email = C('Alipay.seller_email');//卖家支付宝帐户必填
        $out_trade_no = $trade_no;//商户订单号 通过支付页面的表单进行传递，注意要唯一！
        $total_fee = '0.1';   //付款金额  //必填 通过支付页面的表单进行传递
        $subject = '订单名称';  //订单名称 //必填 通过支付页面的表单进行传递
        $body = '订单描述';//订单描述 通过支付页面的表单进行传递
        $anti_phishing_key = "";//防钓鱼时间戳 //若要使用请调用类文件submit中的query_timestamp函数
        $exter_invoke_ip = get_client_ip(); //客户端的IP地址
        //构造要请求的参数数组，无需改动

        $parameter = array(
            "service" => "create_direct_pay_by_user",
            "partner" => trim($alipayConfig['partner']),
            "payment_type"    => $payment_type,
            "notify_url"    => $notify_url,
            "return_url"    => $return_url,
            "seller_email"    => $seller_email,
            "out_trade_no"    => $out_trade_no,
            "subject"    => $subject,
            "total_fee"    => $total_fee,
            "body"            => $body,
            "show_url"    => 'http://test.com',
            "anti_phishing_key"    => $anti_phishing_key,
            "exter_invoke_ip"    => $exter_invoke_ip,
            "_input_charset"    => trim(strtolower($alipayConfig['input_charset']))
        );
        //建立请求
        $AlipaySubmit = new \AlipaySubmit($alipayConfig);
        $html_text = $AlipaySubmit->buildRequestForm($parameter, "post", "确认");
        echo $html_text;
    }

    /******************************
    服务器异步通知页面方法
    其实这里就是将notify_url.php文件中的代码复制过来进行处理
     *******************************/
    function notifyurl(){
        $this->_ImportAlipy();
        //这里还是通过C函数来读取配置项，赋值给$alipay_config
        $alipayConfig = C('AlipayConfig');
        //计算得出通知验证结果
        $alipayNotify = new \AlipayNotify($alipayConfig);
        $verify_result = $alipayNotify->verifyNotify();
        if($verify_result) {
            //验证成功
            //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
            $out_trade_no   = $_POST['out_trade_no'];      //商户订单号
            $trade_no       = $_POST['trade_no'];          //支付宝交易号
            $trade_status   = $_POST['trade_status'];      //交易状态
            $total_fee      = $_POST['total_fee'];         //交易金额
            $notify_id      = $_POST['notify_id'];         //通知校验ID。
            $notify_time    = $_POST['notify_time'];       //通知的发送时间。格式为yyyy-MM-dd HH:mm:ss。
            $buyer_email    = $_POST['buyer_email'];       //买家支付宝帐号；
            $parameter = array(
                "out_trade_no"  => $out_trade_no, //商户订单编号；
                "trade_no"      => $trade_no,     //支付宝交易号；
                "total_fee"     => $total_fee,    //交易金额；
                "trade_status"  => $trade_status, //交易状态
                "notify_id"     => $notify_id,    //通知校验ID。
                "notify_time"   => $notify_time,  //通知的发送时间。
                "buyer_email"   => $buyer_email,  //买家支付宝帐号;
            );
            if($_POST['trade_status'] == 'TRADE_FINISHED') {
                //
            }else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
                //检测是否支付成功（由支付宝返回的订单号去订单支付表中查找）
                if(!checkorderstatus($out_trade_no)){
                    echo "skskks";
                    //进行订单处理，并传送从支付宝返回的参数；
                }
            }
            echo "success";        //请不要修改或删除
        }else {
            //验证失败
            echo "fail";
        }
    }


    function returnurl(){
        $this->_ImportAlipy();
        //头部的处理跟上面两个方法一样，这里不罗嗦了！
        $alipayConfig = C('AlipayConfig');
        $alipayNotify = new \AlipayNotify($alipayConfig);//计算得出通知验证结果
        $verify_result = $alipayNotify->verifyReturn();
        if($verify_result) {
            //验证成功
            //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
            $out_trade_no   = $_GET['out_trade_no'];      //商户订单号
            $trade_no       = $_GET['trade_no'];          //支付宝交易号
            $trade_status   = $_GET['trade_status'];      //交易状态
            $total_fee      = $_GET['total_fee'];         //交易金额
            $notify_id      = $_GET['notify_id'];         //通知校验ID。
            $notify_time    = $_GET['notify_time'];       //通知的发送时间。
            $buyer_email    = $_GET['buyer_email'];       //买家支付宝帐号；

            $parameter = array(
                "out_trade_no"     => $out_trade_no,      //商户订单编号；
                "trade_no"     => $trade_no,          //支付宝交易号；
                "total_fee"      => $total_fee,         //交易金额；
                "trade_status"     => $trade_status,      //交易状态
                "notify_id"      => $notify_id,         //通知校验ID。
                "notify_time"    => $notify_time,       //通知的发送时间。
                "buyer_email"    => $buyer_email,       //买家支付宝帐号
            );

            if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
                if(!checkorderstatus($out_trade_no)){
                    echo "sksksk";
                }
                $this->redirect(C('alipay.successpage'));//跳转到配置项中配置的支付成功页面；
            }else {
                echo "trade_status=".$_GET['trade_status'];
                $this->redirect(C('alipay.errorpage'));//跳转到配置项中配置的支付失败页面；
            }
        }else {
            //验证失败
            //如要调试，请看alipay_notify.php页面的verifyReturn函数
            echo "支付失败！";
        }
    }



}