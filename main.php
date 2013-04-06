<?php

/**
  * wechat php test
  */

//hhhh

define("TOKEN", "testfrowczhemenan");

define("MAINLIST","---------------\n1.回复crr发布活动信息\n2.回复chh查询活动信息\n");
define("GUANZHUNOTE","中南大学校友会欢迎您！中南大学校友会为深圳地区校友提供活动、交友信息。感谢您的参与！\n" . MAINLIST);

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
				$msgtyp = $postObj->MsgType;
				$ret = "";
				MyLog("msgtyp:" . $msgtyp);
				switch($msgtyp){
					case "text":
						$ret = $this->handleMsgText($postObj);
						break;
					case "event":
						$ret = $this->handleMsgEvent($postObj);
						break;
					default:
						$ret = "";
				}
				echo $ret  ;
        }else {
        	echo "";
        	exit;
        }
    }
	
	public function handleMsgOther($obj){
		$postObj = $obj;
		$fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $keyword = trim($postObj->Content);
        $time = time();
        $textTpl = "<xml>
				<ToUserName><![CDATA[%s]]></ToUserName>
				<FromUserName><![CDATA[%s]]></FromUserName>
				<CreateTime>%s</CreateTime>
				<MsgType><![CDATA[%s]]></MsgType>
				<Content><![CDATA[%s]]></Content>
				<FuncFlag>0</FuncFlag>
				</xml>";  
		$msgType = "text";
        $contentStr = MMSGOTHERNOTE;
        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
        return $resultStr;
	}
	
	public function handleMsgText($obj){
		$postObj = $obj;
		$fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $keyword = trim($postObj->Content);
        $time = time();
        $textTpl = "<xml>
				<ToUserName><![CDATA[%s]]></ToUserName>
				<FromUserName><![CDATA[%s]]></FromUserName>
				<CreateTime>%s</CreateTime>
				<MsgType><![CDATA[%s]]></MsgType>
				<Content><![CDATA[%s]]></Content>
				<FuncFlag>0</FuncFlag>
				</xml>";  
		$msgType = "text";
        $contentStr = $this->handleMsgTest($keyword, $fromUsername);
        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
        return $resultStr;
	}
	
	public function handleMsgEvent($obj){
		MyLog("handleMsgEvent");
		$postObj = $obj;
		$fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        //$keyword = trim($postObj->Content);
		$event = $postObj->Event;
        $time = time();
        $textTpl = 	"<xml>
 					 <ToUserName><![CDATA[%s]]></ToUserName>
					 <FromUserName><![CDATA[%s]]></FromUserName>
					 <CreateTime>%s</CreateTime>
					 <MsgType><![CDATA[%s]]></MsgType>
					 <ArticleCount>2</ArticleCount>
					 <Articles>
					 <item>
					 <Title><![CDATA[%s]]></Title> 
					 <Description><![CDATA[%s]]></Description>
					 <PicUrl><![CDATA[%s]]></PicUrl>
					 <Url><![CDATA[%s]]></Url>
					 </item>
					 <item>
					 <Title><![CDATA[%s]]></Title>
					 <Description><![CDATA[%s]]></Description>
					 <PicUrl><![CDATA[%s]]></PicUrl>
					 <Url><![CDATA[%s]]></Url>
					 </item>
					 </Articles>
					 <FuncFlag>1</FuncFlag>
					 </xml> ";  
		$msgType = "news";
		if ($event == "subscribe"){
			$title1 = "Title One";
			$des1 = "Description one";
			$picUrl1 = "http://www.likemeili.com/wx/test/img/pic1.jpg";
			$url1 = "http://www.likemeili.com/wx/test/img/pic1.jpg";
			$title2 = "查看好友";
			$des2 = "Description two";
			$picUrl2 = "http://www.likemeili.com/wx/test/viewfri.html";
			$url2 = "http://www.likemeili.com/wx/test/img/pic2.jpg";
		}
        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, 
        				$title1, $des1, $picUrl1, $url1, $title2, $des2, $picUrl2, $url2);
        return $resultStr;
	}
	

	public function handleMsgTest($req, $fromUser){
		$ret = '';
		switch($req){
			//查看最新
			case CREATEACTIVE:	
				$ret = $this->handleViewNew($fromUser);
				break;
			//自己写错过
			case RIT:
				$ret = $this->handleShowActivity();
				break;
			//查看好友
			case VIEWFRIEND:
				$ret = VIEWFRIEND1NOTE;
				$this->updateUserState($fromUser, VIEWFRIENDINPUT);
				break;
			default:
				$ret = $this->handleContent($req, $fromUser);
		}
		return $ret;
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
  