<?php
require_once dirname(__FILE__) . "/common.php";
require_once dirname(__FILE__) . "/class/NewsHelper.php";
require_once dirname(__FILE__) . "/common/MiniLog.php";

/**
 * 
 * @author dvking
 *
 */
class CSUXYH{
	private $postObj;
	public function __construct($obj){
		$this->postObj = $obj;
	}
	
	public function process(){
		Debug( __FUNCTION__);
		$obj = $this->postObj;
		$msgtyp = $obj->MsgType;
		$ret = "";
		MyLog("msgtyp:" . $msgtyp);
		switch($msgtyp){
			case "text":
				$ret = $this->handleMsgText($obj);
				break;
			case "event":
				$ret = $this->handleMsgEvent($obj);
				break;
			case "link":
				$ret = $this->handleMsgLink($obj);
				break;
			default:
				$ret = "";
		}
		echo $ret  ;
	}
	
	public function handleMsgOther($obj){
		Debug( __FUNCTION__);
		$postObj = $obj;
		$fromUsername = $postObj->FromUserName;
		$toUsername = $postObj->ToUserName;
		$keyword = trim($postObj->Content);
		$time = time();
		$textTpl = TEXTTPL;
		$msgType = "text";
		$contentStr = MMSGOTHERNOTE;
		$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
		return $resultStr;
	}
	
	public function handleMsgText($obj){
		Debug( __FUNCTION__);
		$postObj = $obj;
		$fromUsername = $postObj->FromUserName;
		$toUsername = $postObj->ToUserName;
		$keyword = trim($postObj->Content);
		$time = time();
		$textTpl = TEXTTPL;
		$msgType = "text";
		$contentStr = $this->handleMsgTest($keyword, $fromUsername);
		$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
		return $resultStr;
	}
	
	public function handleMsgEvent($obj){
		Debug( __FUNCTION__);
		$postObj = $obj;
		$fromUsername = $postObj->FromUserName;
		$toUsername = $postObj->ToUserName;
		//$keyword = trim($postObj->Content);
		$event = $postObj->Event;
		$time = time();
		$msgType = "news";
		$ret = '';
		if ($event == "subscribe"){
			$nhelper = new NewsHelper();
			$url1 = sprintf(URL1,$fromUsername);
			$nhelper->addItem(TITLE1, DES1, PICURL1, $url1);
			$url2 = sprintf(URL2,$fromUsername);
			$nhelper->addItem(TITLE2, DES2, PICURL2, $url2);
			$url3 = sprintf(URL3,$fromUsername);
			$nhelper->addItem(TITLE3, DES3, PICURL3, $url3);
			$url4 = sprintf(URL4,$fromUsername);
			$nhelper->addItem(TITLE4, DES4, PICURL4, $url4);
			$url5 = sprintf(URL5,$fromUsername);
			$nhelper->addItem(TITLE5, DES5, PICURL5, $url5);
			$items = $nhelper->getItems();
			$ret = sprintf(NEWSTPL, $fromUsername, $toUsername, $time, $msgType, 
							5, $items);
		}
		
		return $ret;
	}
	
	public function handleMsgTest($req, $fromUser){
		Debug( __FUNCTION__);
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
	
}

///

?>