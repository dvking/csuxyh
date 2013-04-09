<?php
require_once  dirname(__FILE__) . "/MiniLog.php";


function Debug($msg){
	$log = MiniLog::instance(dirname(__FILE__) . "/../log/");
	$log->log(DEBUG, $msg);
}


?>