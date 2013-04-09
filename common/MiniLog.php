<?php
/**
 * 
 * @author dvking
 *
 */
class MiniLog {
	
	private static $_instance;
	private $_path;
	private $_processId;
	private $_handler;
	private function __construct($path) {
		$this->_path = $path;
		$this->_processId = getmypid();
	}
	
	private function __clone(){
		
	}
	
	public static function instance($path = "/tmp"){
		if(!(self::$_instance instanceof  self )){
			self::$_instance = new self($path);
		}
		return  self::$_instance;
	}
	
	private function getHandler($file){
		if($this->_handler[$file]){
			return $this->_handler[$file];
		}
		$today = date("Ymd");
		$fileHandler = fopen($this->_path . $file . $today . ".log", "a");
		$this->_handler[$file] = $fileHandler;
		return $this->_handler[$file];
	}
	
	public function log($file, $msg){
		$handler = $this->getHandler($file);
		fwrite($handler, "[" . date('Ymd H:i:s'). "] [" . $this->_processId
				. "]:" . $msg . "\n");
	}
	
	private function __destruct(){
		foreach($this->_handler as $key => $value){
			if($value){
				close($value);
			}
		}
	}
	
}

?>