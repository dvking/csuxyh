<?php
require_once dirname(__FILE__) . './common/global.php';
/**
  * wechat php test
  */

//hhhh



function MyLog($str){
		$file = fopen("out.log","a+");
		fwrite($file, "\n" . $str);
		fclose($file);
}


$wechatObj = new wechatCallbackapiTest();
//$wechatObj->log("before");
$wechatObj->valid();

class wechatCallbackapiTest
{
	public function valid()
    {
		MyLog("valid");
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
		MyLog("responseMsg");
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		if (!empty($postStr)){
                
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
  