<?php
define("TOKEN", "testfrowczhemenan");
define("MAINLIST","---------------\n1.�ظ�crr�������Ϣ\n2.�ظ�chh��ѯ���Ϣ\n");
define("GUANZHUNOTE","���ϴ�ѧУ�ѻỶӭ�������ϴ�ѧУ�ѻ�Ϊ���ڵ���У���ṩ���������Ϣ����л���Ĳ��룡\n" . MAINLIST);
define("DEBUG","debug");

//�˵���
define("TITLE1","�����");
define("DES1","�������Ϣ");
define("PICURL1","http://www.likemeili.com/wx/test/img/pic1.jpg");
define("URL1","http://www.likemeili.com/wx/test/img/pic1.jpg?user=%s");

define("TITLE2","��ѯ��������");
define("DES2","�������Ϣ");
define("PICURL2","http://www.likemeili.com/wx/test/img/pic2.jpg");
define("URL2","http://www.likemeili.com/wx/test/viewfri.html?user=%s");

define("TITLE3","�����");
define("DES3","�������Ϣ");
define("PICURL3","http://www.likemeili.com/wx/test/img/pic2.jpg");
define("URL3","http://www.likemeili.com/wx/test/viewfri.html?user=%s");

define("TITLE4","�����");
define("DES4","�������Ϣ");
define("PICURL4","http://www.likemeili.com/wx/test/img/pic2.jpg");
define("URL4","http://www.likemeili.com/wx/test/viewfri.html?user=%s");

define("TITLE5","�����");
define("DES5","�������Ϣ");
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


//���ݿ�����
$SQLCONN= array(
				'HOST' => '****',
				'DBNAME' => '**',
				'USER' => '***',
				'PASSWD' => '***',
				'PORT' => 23
            );

















?>
