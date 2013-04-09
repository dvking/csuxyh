<?php
require_once dirname(__FILE__) . '/common/global.php';
require_once dirname(__FILE__) . '/common/globalfunc.php';
require_once dirname(__FILE__) . "/CSUXYH.php";
/**
  * wechat php test
  */


Debug("begin process");
$wechatObj = new wechatCallbackapiTest();
//$wechatObj->log("before");
$wechatObj->valid();

class wechatCallbackapiTest
{
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
			//MyLog("checkSignature");
        	echo $echoStr;
			//
			$this->responseMsg();
        	exit;
        }
    }
	

    public function responseMsg()
    {
		Debug( __FUNCTION__);
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		if (!empty($postStr)){
				Debug("postStr not empty");
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
              	$csuxyh = new CSUXYH($postObj);
              	$ret = $csuxyh->process();
              	echo $ret;
				
        }else {
        	echo "";
        	exit;
        }
    }

	
	private function checkSignature()
	{
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
	
}



?>
  