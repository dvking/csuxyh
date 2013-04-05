<?php

/**
  * wechat php test
  */

  
  //dvking

  //test

define("TOKEN", "testfrowczhemenan");

define("DBHOST","127.0.0.1");
define("DBUSER","root");
define("PASSWD","ZHOUnan1");
define("DBNAME","lkml");
//定义状态项
// 0-- normal
define("NORMAL",0);
define("INPUTRIT",2);
define("INPUTNAME",3);
define("VIEWFRIENDINPUT",10);
//定义查询最大条数
define("MAXMSGNUM",2);
define("MAXMSGLEN",1900);
define("VIEWSELECTSQL","SELECT * FROM wx_cgdt_msg AS t1 JOIN (SELECT ROUND( RAND( ) * ( SELECT MAX( msgid )-" . MAXMSGNUM . " FROM wx_cgdt_msg )) AS id) AS t2 WHERE t1.msgid >= t2.id ORDER BY t1.msgid LIMIT " . MAXMSGNUM);

//定义菜单
define("CREATEACTIVE","crr");
define("ST_CREAT_ACT_INPUT_NAME",20);
define("ST_CREAT_ACT_INPUT_MOBILE",21);
define("ST_CREAT_ACT_INPUT_ACT_NAME",22);
define("ST_CREAT_ACT_INPUT_ACT_DATE",23);
define("ST_CREAT_ACT_INPUT_ACT_LOC",24);
define("ST_CREAT_ACT_INPUT_ACT_CONTENT",25);
define("ST_JOIN_ACT_INPUT_ACT_NAME",40);
define("ST_JOIN_ACT_INPUT_ACT_MOBILE",41);
define("ST_JOIN_ACT_INPUT_ACT_AGE",42);
define("ST_JOIN_ACT_INPUT_ACT_SEX",43);
define("ST_JOIN_ACT_INPUT_ACT_MAJOR",44);
define("RIT","chh");
define("RIT1NOTE","请输入您『错过』的人的名字，并以#号结束， 如： 紫霞仙子#");
define("VIEWFRIEND","fdd");
define("VIEWFRIEND1NOTE","请输入好友的名字crr，并以#号结束， 如： 紫霞仙子#");
define("MAINLIST","---------------\n1.回复crr发布活动信息\n2.回复chh查询活动信息\n");
define("GUANZHUNOTE","中南大学校友会欢迎您！中南大学校友会为深圳地区校友提供活动、交友信息。感谢您的参与！\n" . MAINLIST);
define("DEFAULTNOTE","欢迎关注错过的TA，本号正在建设中，感谢您的继续关注！");
define("INPUTNAMEERR","您输入的格式有误，请重新输入您『错过』的人的名字，并以#结束，如：紫霞仙子#");
define("RIT2NOTE","请输入您想对错过的人说的话。");
define("VIEWFRIINPUTNAMEERR","您输入的格式有误，请重新输入好友的名字，并以#结束，如：紫霞仙子#");
define("MMSGOTHERNOTE","本号目前仅支持文本消息，您输入的类型正在开发中，如有更新，本号会第一时间请您使用，谢谢您的理解支持！" . MAINLIST);
define("RITSUCCESS","您已添加成功，感谢您的分享！\n" . MAINLIST);
//define your token


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
			MyLog("checkSignature");
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
        $textTpl = "<xml>
				<ToUserName><![CDATA[%s]]></ToUserName>
				<FromUserName><![CDATA[%s]]></FromUserName>
				<CreateTime>%s</CreateTime>
				<MsgType><![CDATA[%s]]></MsgType>
				<Content><![CDATA[%s]]></Content>
				<FuncFlag>0</FuncFlag>
				</xml>";  
		$msgType = "text";
		if ($event == "subscribe"){
			$contentStr = GUANZHUNOTE;
		}
        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
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

	
	public function handleViewNew($user){
		$con = mysql_connect(DBHOST,DBUSER,PASSWD);
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		mysql_set_charset('utf8',$con);
		mysql_select_db(DBNAME, $con);
		$result = mysql_query("select * from wx_csuxyh_user where sessionid='" . $user . "'",$con);
		$ret = $this->userSetToString($result);
		$this->updateUserStateCon($user, ST_CREAT_ACT_INPUT_NAME, $con);
		mysql_close($con);
		$ret = $ret . MAINLIST;
		return $ret;
	}
	
	public function userSetToString($res){
		$ret = "请您输入您的名字,并以#号结束：";
		if($row = mysql_fetch_array($res)){
			$name = $row["name"];
			$mobile = $row["mobile"];
			if(strlen($name) > 0){
				$ret = $ret . "（姓名为：" . $name . ",确认请回复0，否则输入您的名字）\n";
			}
		}
		return $ret;
	}
	
	//获取线上发布的所有活动的简单信息，包括活动ID，活动时间及活动名称
	public function handleShowActivity(){
	    $con = mysql_connect(DBHOST,DBUSER,PASSWD);
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		mysql_set_charset('utf8',$con);
		mysql_select_db(DBNAME, $con);
		$selAct = "select activityID,activitytime,activityname from wx_csuxyh_activity order by activityid desc";
		$result = mysql_query(selAct,$con);
		$row_num = mysql_num_rows($result);
		MyLog("\n row" . $row_num);
		$ret = $row_num;
		if($row_num > 0)
		{
		    $ret = "-----------------\n活动编号  活动时间  活动名称\n";
		    while($row = mysql_fetch_array($result)){
			   $tmpmsg = $row["activityID"]."     ".$row["activitytime"]."     ".$row["activityname"];
			   $ret = $ret . $tmpmsg;
			   if(strlen($ret) > MAXMSGLEN){
				break;
				}
			}
		}
		else
		{
		  // $ret = $ret . "无活动";
		}
		mysql_close($con);
		return $ret;
	}
	
	public function msgSetToString($res){
		$ret = "";
		$i = 1;
		while($row = mysql_fetch_array($res)){
			$tmpmsg = $i . ". 错过的   『" . $row["toname"] . "』:\n" . $row["msg"] . "\n" ;
			if(strlen($ret . $tmpmsg) > MAXMSGLEN){
				break;
			}
			$ret = $ret . $tmpmsg;
			$i = $i + 1;
		}
		$i = $i - 1;
		$ret = "找到" . $i . "条『错过』\n" . $ret;
		return $ret;
	}
		
	public function handleContent($ct, $user){
		$con = mysql_connect(DBHOST,DBUSER,PASSWD);
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		mysql_set_charset('utf8',$con);
		mysql_select_db(DBNAME, $con);
		$stat = $this->getUserState($con, $user);
		//return $stat;
		switch($stat){
			case ST_CREAT_ACT_INPUT_NAME:
				$ret = $this->handleInputName($con, $ct, $user,ST_CREAT_ACT_INPUT_MOBILE);
				break;
			case ST_CREAT_ACT_INPUT_MOBILE:
				$ret = $this->handleInputMobile($con, $ct, $user,ST_CREAT_ACT_INPUT_ACT_NAME);
				break;
			case ST_CREAT_ACT_INPUT_ACT_NAME:
				$ret = $this->handleInputActName($con, $ct, $user,ST_CREAT_ACT_INPUT_ACT_DATE);
				break;
			case ST_CREAT_ACT_INPUT_ACT_DATE:
				$ret = $this->handleInputActDate($con, $ct, $user,ST_CREAT_ACT_INPUT_ACT_LOC);
				break;
			case ST_CREAT_ACT_INPUT_ACT_LOC:
				$ret = $this->handleInputActLoc($con, $ct, $user,ST_CREAT_ACT_INPUT_ACT_CONTENT);
				break;
			case ST_CREAT_ACT_INPUT_ACT_CONTENT:
				$ret = $this->handleInputActContent($con, $ct, $user,NORMAL);
				break;
			case ST_JOIN_ACT_INPUT_ACT_NAME:
				$ret = $this->handleInputName($con, $ct, $user,ST_JOIN_ACT_INPUT_ACT_MOBILE);
				break;
			case ST_JOIN_ACT_INPUT_ACT_MOBILE:
				$ret = $this->handleJoinInputMobile($con, $ct, $user,ST_JOIN_ACT_INPUT_ACT_AGE);
				break;
			case ST_JOIN_ACT_INPUT_ACT_AGE:
				$ret = $this->handleJoinInputAge($con, $ct, $user,ST_JOIN_ACT_INPUT_ACT_SEX);
				break;
			case ST_JOIN_ACT_INPUT_ACT_SEX:
				$ret = $this->handleJoinInputSex($con, $ct, $user,ST_JOIN_ACT_INPUT_ACT_MAJOR);
				break;
			case ST_JOIN_ACT_INPUT_ACT_MAJOR:
				$ret = $this->handleJoinInputMajor($con, $ct, $user,NORMAL);
				break;
			case VIEWFRIENDINPUT:
				$ret = $this->handleViewFriInputName($con, $ct, $user);
				break;
			default:
				$ret = MAINLIST;
		}
		mysql_close($con);
		return $ret ;
	}
	
	public function handleViewFriInputName($con, $ct, $user){
		//是否#号结束
		$pos = strpos($ct, '#');
		//return $pos;
		//return strlen($ct);
		if($pos === false || $pos != (strlen($ct) - 1) ){
			return VIEWFRIINPUTNAMEERR;
		}
		$toname = substr($ct, 0, $pos);
		$selSql = "select * from wx_cgdt_msg where toname='" . $toname ."'"; 
		//return $updStr;
		$res = mysql_query($selSql, $con);
		$ret = $this->msgSetToString($res);
		$this->updateUserStateCon($user, NORMAL, $con);
		$ret = $ret . MAINLIST;
		return $ret;
	}
	
	public function handleInputActAge($con, $ct, $user,$succstat){
		$ret = "";
		$updStr = "update wx_csuxyh_user set age=" . $ct . 
							" where sessionid='" . $user ."'"; 
		//return $updStr;
		mysql_query($updStr, $con);
		$ret = "请你输入活动的时间（某一天或一个时间段：20130401-20130402）：";
		$this->updateUserStateCon($user, $succstat, $con);
		return $ret;
	}
	
	public function handleInputActName($con, $ct, $user,$succstat){
		$ret = "";
		$updStr = "update wx_csuxyh_user set cachemsg='" . $ct . 
							"#' where sessionid='" . $user ."'"; 
		//return $updStr;
		mysql_query($updStr, $con);
		$ret = "请你输入活动的时间（某一天或一个时间段：20130401-20130402）：";
		$this->updateUserStateCon($user, $succstat, $con);
		return $ret;
	}
	
	public function handleInputActDate($con, $ct, $user,$succstat){
		$ret = "";
		$updStr = "update wx_csuxyh_user set cachemsg=concat(cachemsg,'" . $ct . 
							"#') where sessionid='" . $user ."'"; 
		//return $updStr;
		mysql_query($updStr, $con);
		$ret = "请你输入活动的地点（如深圳红树林）：";
		$this->updateUserStateCon($user, $succstat, $con);
		return $ret;
	}
	
	public function handleInputActLoc($con, $ct, $user,$succstat){
		$ret = "";
		$updStr = "update wx_csuxyh_user set cachemsg=concat(cachemsg,'" . $ct . 
							"#') where sessionid='" . $user ."'"; 
		//return $updStr;
		mysql_query($updStr, $con);
		$ret = "请你输入活动的内容（如红树林踩单车）：";
		$this->updateUserStateCon($user, $succstat, $con);
		return $ret;
	}
	
	public function handleInputActContent($con, $ct, $user,$succstat){
		$ret = "";
		$sql = "select * from wx_csuxyh_user where sessionid='" . $user . "'";
		$result = mysql_query($sql, $con);
		$row = mysql_fetch_array($result);
		$cachemsg = $row["cachemsg"];
		$msg = explode("#", $cachemsg);
		$insSql = "insert into wx_csuxyh_activity (sessionid,activityname,activitytime,activitylocation, activitycontent, stat) values ('" . $user . "','" . $msg[0] . "','" . $msg[1] . "','" . $msg[2] . "','" . $ct ."',0)";
		MyLog($insSql);
		//return $updStr;
		mysql_query($insSql, $con);
		$ret = "您已成功创建活动，感谢你的参与，谢谢！";
		$this->updateUserStateCon($user, $succstat, $con);
		return $ret;
	}
	
	public function handleInputMobile($con, $ct, $user,$succstat){
		$ret = "";
		if(strcmp($ct,"1") != 0){
				$updStr = "update wx_csuxyh_user set mobile='" . $ct . 
							"' where sessionid='" . $user ."'"; 
				//return $updStr;
				mysql_query($updStr, $con);
				
		}
		$ret = "请你输入活动的主题名称：";
		$this->updateUserStateCon($user, $succstat, $con);
		return $ret;
	}
	
	public function handleJoinInputMobile($con, $ct, $user,$succstat){
		$ret = "";
		if(strcmp($ct,"1") != 0){
				$updStr = "update wx_csuxyh_user set mobile='" . $ct . 
							"' where sessionid='" . $user ."'"; 
				//return $updStr;
				mysql_query($updStr, $con);
				
		}
		$ret = "请你输入年龄：";
		$this->updateUserStateCon($user, $succstat, $con);
		return $ret;
	}
	
	public function handleJoinInputAge($con, $ct, $user,$succstat){
		$ret = "";
		if(strcmp($ct,"1") != 0){
				$updStr = "update wx_csuxyh_user set age=" . $ct . 
							" where sessionid='" . $user ."'"; 
				//return $updStr;
				mysql_query($updStr, $con);
				
		}
		$ret = "请你输入性别：";
		$this->updateUserStateCon($user, $succstat, $con);
		return $ret;
	}
	
	public function handleJoinInputSex($con, $ct, $user,$succstat){
		$ret = "";
		if(strcmp($ct,"1") != 0){
				$updStr = "update wx_csuxyh_user set sex=‘" . $ct . 
							"’ where sessionid='" . $user ."'"; 
				//return $updStr;
				mysql_query($updStr, $con);
				
		}
		$ret = "请你输入专业：";
		$this->updateUserStateCon($user, $succstat, $con);
		return $ret;
	}
	
	public function handleJoinInputMajor($con, $ct, $user,$succstat){
		$ret = "";
		if(strcmp($ct,"1") != 0){
				$updStr = "update wx_csuxyh_user set major=‘" . $ct . 
							"’ where sessionid='" . $user ."'"; 
				//return $updStr;
				mysql_query($updStr, $con);
				
		}
		$sql = "select * from wx_csuxyh_user where sessionid='" . $user . "'";
		$result = mysql_query($sql,$con);
		$row = mysql_fetch_array($result);
		$insSql = "insert into wx_csuxyh_activityuser values(" . $row["cachemsg"] . ",'" . $user . 				"')";
		mysql_query($insSql, $con);
		$ret = "您已报名活动，谢谢您的参与！";
		$this->updateUserStateCon($user, $succstat, $con);
		return $ret;
	}
	
	public function getUserMobile($user,$con){
		$sql = "select * from wx_csuxyh_user where sessionid='" . $user . "'";
		$result = mysql_query($sql, $con);
		$row = mysql_fetch_array($result);
		return $row["mobile"];
		
	}
	
	public function handleInputName($con, $ct, $user,$succstat){
		$ret = "";
		if(strcmp($ct,"1") == 0){
			$mobile = $this->getUserMobile($user,$con);
			$ret = $ret . "请你输入您的手机号:";
			if(strlen($mobile)){
				$ret  = $ret . "（您的手机号为：" . $mobile . "确认请回复0,否则请输入）";
			}
			$this->updateUserStateCon($user, $succstat, $con);
		}else{
			//是否#号结束
			$pos = strpos($ct, '#');
			//return $pos;
			//return strlen($ct);
			if($pos === false || $pos != (strlen($ct) - 1) ){
				$ret = $ret . INPUTNAMEERR;
				$result = mysql_query("select * from wx_csuxyh_user where sessionid='" 
										. $user . "'"	,$con);
				$ret = $ret . $this->userSetToString($result);
			}else{
				$updStr = "update wx_csuxyh_user set name='" . substr($ct,0,$pos) . 
							"' where sessionid='" . $user ."'"; 
				//return $updStr;
				mysql_query($updStr, $con);
				$mobile = $this->getUserMobile($user,$con);
				$ret = $ret . "请你输入您的手机号:";
				if(strlen($mobile)){
					$ret  = $ret . "（您的手机号为：" . $mobile . "确认请回复0,否则请输入）";
				}
				$this->updateUserStateCon($user, $succstat, $con);
			}
		}
		return $ret;
	}
	
	public function getUserState($con, $user){
		$sqlStr = "select stat from wx_csuxyh_user where sessionid='" . $user ."'";
		$result = mysql_query($sqlStr, $con);
		$row = mysql_fetch_array($result);
		return $row["stat"];
	}
	
	
	public function updateUserState($user, $st){
		$con = mysql_connect(DBHOST,DBUSER,PASSWD);
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		mysql_set_charset('utf8',$con);
		mysql_select_db(DBNAME, $con);
		$sqlTmp = "select * from wx_cgdt_userstat where custid='" . $user . "'" ;
		$rowNum = mysql_num_rows(mysql_query($sqlTmp,$con));
		if($rowNum == 1){
			$updSql = "update wx_cgdt_userstat set stat=" . $st . "  where custid='" . $user . "'";
		}else{
			$updSql = "insert into wx_cgdt_userstat values('" . $user . "'," . $st . ",'')";
		}
		mysql_query($updSql,$con);
		mysql_close($con);
	}
	public function updateUserStateCon($user, $st, $con){

		$sqlTmp = "select * from wx_csuxyh_user where sessionid='" . $user . "'" ;
		$rowNum = mysql_num_rows(mysql_query($sqlTmp,$con));
		if($rowNum == 1){
			$updSql = "update wx_csuxyh_user set stat=" . $st . "  where sessionid='" . $user . "'";
		}else{
			$updSql = "insert into wx_csuxyh_user(sessionid,stat) values('" . $user . "'," . $st . ")";
		}
		//return $updSql;
		mysql_query($updSql,$con);
	}
	
	public function handleInsert($msgInsert, $fromUser ){
		$i = strpos($msgInsert,"#");
		$toname = substr($msgInsert, 0, $i);
		while($msgInsert[$i] == "#"){
			$i = $i + 1;
		}
		$msg = substr($msgInsert, $i);
		$sqlstr = "insert into wx_cgdt_msg(custid,toname,msg) values ('" . $fromUser . "','"
				. $toname . "','" . $msg . "')";
		$this->update($sqlstr );
	}
	
	public function update($sqlStr){
		$con = mysql_connect(DBHOST,DBUSER,PASSWD);
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		mysql_set_charset('utf8',$con);
		mysql_select_db(DBNAME, $con);
		mysql_query($sqlStr,$con);
		mysql_close($con);
	}
	
	public function select($sqlStr){
		$con = mysql_connect(DBHOST,DBUSER,PASSWD);
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		mysql_set_charset('utf8',$con);
		mysql_select_db(DBNAME, $con);
		$ret = mysql_query($sqlStr,$con);
		mysql_close($con);
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
  