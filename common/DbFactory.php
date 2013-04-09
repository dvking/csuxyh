<?php
include_once dirname(__FILE__) . '/Mysqldb.php';
/**
 * 
 * Dbµ¥¼þÀà
 *   @author pacozhong
 *
 */
class DbFactory {
    private static $db = array();
    public static function getInstance($dbKey = 'CSUXYHS') {
        if (array_key_exists($dbKey, self::$db)) {
            return self::$db[$dbKey];
        } else {
            $newdb = new Mysqldb($dbKey);
            if ($newdb->connect()) {
                self::$db[$dbKey] = $newdb;
                return $newdb;
            } else {
                return false;
            }
        }
    }
}
?>