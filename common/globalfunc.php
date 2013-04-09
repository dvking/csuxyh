<?php

function Debug($msg){
	$log = MiniLog::instance(dirname(__FILE__) . "./../");
	$log->log(DEBUG, $msg);
}


?>