<?php
require_once dirname(__FILE__) . '/common/DBFactory.php';
echo "��ӭ����" . $_POST["username"];

$dbo = DbFactory::getInstance();
$sql = "select * from wx_csuxyh_act";
$rs = $dbo->query($sql);
$array = $dbo->fetch($rs);
Debug($array[1][1]);
?>