<?php
require_once  dirname(__FILE__) . "/MiniLog.php";

function Debug($msg){
	$log = MiniLog::instance(dirname(__FILE__) . "/../log/");
	$log->log(DEBUG, $msg);
}
/**
     * 转义需要插入或者更新的字段值
     *
     * 在所有查询和更新的字段变量都需要调用此方法处理数据
     *
     * @param mixed $str 需要处理的变量
     * @return mixed 返回转义后的结果
     */
   function escape($str) {
        if (is_array($str)) {
            foreach ($str as $key => $value) {
                $str[$key] = $this->escape($value);
            }
        } else {
            return addslashes($str);
        }
        return $str;
    }
?>