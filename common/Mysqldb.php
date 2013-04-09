<?php

require_once dirname(__FILE__) . '/global.php';
require_once dirname(__FILE__) . '/globalfunc.php';
/**
 * @author Lenovo
 *
 */
class Mysqldb {
	
	const  DB_FETCH_ASSOC =  MYSQLI_ASSOC;  //���ص�������ʹ���ֶ�����Ϊ�������������
	const  DB_FETCH_NUM = MYSQL_NUM;          //���ص�������ʹ������������Ϊ�����������,������ 0 ��ʼ��
	const  DB_FETCH_BOTH = MYSQL_BOTH;        //���ص�������ʹ���ֶ���������������Ϊ�������������
	const  DB_FETCH_DEFAULT = self::DB_FETCH_ASSOC; //Ĭ�ϲ����ֶ�����ʽ����
					
    private $_dbKey;		
    private $_link;		
    private $_fecthMode;
    
    //���캯����ʼ����������
	public function  __construct($dbKey , $fetchMode = DB_FETCH_DEFAULT){
		$this->_dbKey = $SQLCONN[$dbKey];
		$this->_fecthMode = $fetchMode;
	}
	
	//�������ݿ�
	public function connect() {
		$dbHost = $this->_dbKey['HOST'];
		$dbName = $this->_dbKey['DBNAME'];
		$dbUser = $this->_dbKey['USER'];
		$dbPasswd = $this->_dbKey['PASSWD'];
		$dbPort = $this->_dbKey['PORT'];
		
		$_link = mysqli_init();
		if(!$this->_link)
		{
			return false;
		}
		
		$myconn = mysqli_real_connect($this->link,$dbHost,$dbUser,$dbPasswd,$dbName,
				                                                   $dbPort,NULL,MYSQLI_CLIENT_FOUND_ROWS);
		          
		if(mysqli_connect_errno()){
			printf("Connect failed:%s\n",mysqli_connect_error());
			return false;
		}
		
		$sql = "SET NAMES latin1";
		$this->update ( $sql );
		return true;
	}
	
// 	�ر����ݿ�
	public function close()
	{
		if (is_object ( $this->_link )) {
			mysqli_close ( $this->_link );
		}
	}

	/**
	 * ִ��SQL��ѯ
	 * @param $sql ��ѯsql���
	 * @return resource $rs ��ѯ�����Դ���
	 */
public	function query($sql)
	{
		if(!$link||$this->ping($link))
		{
			return false;
		}
		else
		{
			$this->connect($db);
		}
		$qrs = mysqli_query($this->_link,$sql);
		if (!$qrs) {
			return false;
		} else {
			return $qrs;
		}
	}
	/**
	 * ��ȡ�����
	 * @param resource $rs ��ѯ�����Դ���
	 * @param const $fetchMode ���ص����ݸ�ʽ
	 * @return array �������ݼ�ÿһ�У�����$rsָ������
	 */
	function fetch($rs, $fetchMode = self::DB_FETCH_DEFAULT)
	{
		$fields =mysqli_fetch_fields($rs);
		$values = mysqli_fetch_array($rs, $fetchMode);
	    if ($values) {
	        foreach ($fields as $field) {
	            switch ($field->type) {
	                case MYSQLI_TYPE_TINY:
	                case MYSQLI_TYPE_SHORT:
	                case MYSQLI_TYPE_INT24:
	                case MYSQLI_TYPE_LONG:
	                	 if($field->type == MYSQLI_TYPE_TINY && $field->length == 1) {
							$values[$field->name] = (boolean) $values[$field->name];
	                	 } else {
	                    	$values[$field->name] = (int) $values[$field->name];
	                	 }
					break;
	                case MYSQLI_TYPE_DECIMAL:
	                case MYSQLI_TYPE_FLOAT:
	                case MYSQLI_TYPE_DOUBLE:
	                case MYSQLI_TYPE_LONGLONG:
	                    $values[$field->name] = (float) $values[$field->name];
	                break;
	            }
        	}
    	}
	}
    /**
     * ִ��һ��SQL����
     * �������������ݿ�UPDATE����
     *
     * @param string $sql ���ݿ����SQL���
     * @return boolean
     */
    public function update($sql) {
        if (!$this->_conn || !$this->ping($this->_conn)) {
        	if($this->_autoCommitTime){
        		return false;
        	}
        	else{
        		$this->connect();
        	}
        }
        $urs = mysqli_query($this->_conn, $sql);
        if (!$urs) {
        	return false;
        } else {
            return $urs;
        }
    }
	
	public function ping($conn) {
		return mysqli_ping($conn);
	}
}

?>