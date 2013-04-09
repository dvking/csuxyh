<?php
define("TOKEN", "testfrowczhemenan");
define("MAINLIST","---------------\n1.回复crr发布活动信息\n2.回复chh查询活动信息\n");
define("GUANZHUNOTE","中南大学校友会欢迎您！中南大学校友会为深圳地区校友提供活动、交友信息。感谢您的参与！\n" . MAINLIST);
define("DEBUG","debug");

//菜单项
define("TITLE1","发布活动");
define("DES1","发布活动信息");
define("PICURL1","http://www.likemeili.com/wx/test/img/pic1.jpg");
define("URL1","http://www.likemeili.com/wx/test/img/pic1.jpg?user=%s");

define("TITLE2","查询活动、报名活动");
define("DES2","发布活动信息");
define("PICURL2","http://www.likemeili.com/wx/test/img/pic2.jpg");
define("URL2","http://www.likemeili.com/wx/test/viewfri.html?user=%s");

define("TITLE3","发布活动");
define("DES3","发布活动信息");
define("PICURL3","http://www.likemeili.com/wx/test/img/pic2.jpg");
define("URL3","http://www.likemeili.com/wx/test/viewfri.html?user=%s");

define("TITLE4","发布活动");
define("DES4","发布活动信息");
define("PICURL4","http://www.likemeili.com/wx/test/img/pic2.jpg");
define("URL4","http://www.likemeili.com/wx/test/viewfri.html?user=%s");

define("TITLE5","发布活动");
define("DES5","发布活动信息");
define("PICURL5","http://www.likemeili.com/wx/test/img/pic2.jpg");
define("URL5","http://www.likemeili.com/wx/test/viewfri.html?user=%s");

define("TEXTTPL","	<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[%s]]></MsgType>
					<Content><![CDATA[%s]]></Content>
					<FuncFlag>0</FuncFlag>
					</xml>");

define("NEWSTPL","	<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[%s]]></MsgType>
					<ArticleCount>%d</ArticleCount>
					<Articles>
					%s
					</Articles>
					<FuncFlag>1</FuncFlag>
					</xml> ");

define("ITEMTPL","	<item>
					<Title><![CDATA[%s]]></Title>
					<Description><![CDATA[%s]]></Description>
					<PicUrl><![CDATA[%s]]></PicUrl>
					<Url><![CDATA[%s]]></Url>
					</item>");


//数据库连接
$SQLCONN= array(
				'HOST' => '****',
				'DBNAME' => '**',
				'USER' => '***',
				'PASSWD' => '***',
				'PORT' => 23
            );

















?>
