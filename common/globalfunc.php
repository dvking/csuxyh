<?php
require_once  dirname(__FILE__) . "/MiniLog.php";

function Debug($msg){
	$log = MiniLog::instance(dirname(__FILE__) . "/../log/");
	$log->log(DEBUG, $msg);
}
/**
     * ת����Ҫ������߸��µ��ֶ�ֵ
     *
     * �����в�ѯ�͸��µ��ֶα�������Ҫ���ô˷�����������
     *
     * @param mixed $str ��Ҫ����ı���
     * @return mixed ����ת���Ľ��
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