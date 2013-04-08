<?php
define("TOKEN", "testfrowczhemenan");
define("MAINLIST","---------------\n1.回复crr发布活动信息\n2.回复chh查询活动信息\n");
define("GUANZHUNOTE","中南大学校友会欢迎您！中南大学校友会为深圳地区校友提供活动、交友信息。感谢您的参与！\n" . MAINLIST);


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




















?>
