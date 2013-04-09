<?php
require_once dirname(__FILE__) . '/common/DBFactory.php';
echo "欢迎您" . $_POST["username"];
//dvking
$dbo = DbFactory::getInstance();
$sql = "select * from wx_csuxyh_act";
$rs = $dbo->query($sql);
$array = $dbo->fetch($rs);
Debug($array[1][1]);
?>