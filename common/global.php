<?php
define("TOKEN", "testfrowczhemenan");
define("MAINLIST","---------------\n1.�ظ�crr�������Ϣ\n2.�ظ�chh��ѯ���Ϣ\n");
define("GUANZHUNOTE","���ϴ�ѧУ�ѻỶӭ�������ϴ�ѧУ�ѻ�Ϊ���ڵ���У���ṩ���������Ϣ����л���Ĳ��룡\n" . MAINLIST);


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
