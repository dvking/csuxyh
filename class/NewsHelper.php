<?php
require_once dirname(__FILE__) . "../common/global.php";

/**
 * 
 * @author dvking
 *
 */
class NewsHelper {
	private $newsframe;
	private $items;
	
	public function addItem($title, $des, $picUrl, $url){
		$ret = sprintf(ITEMTPL, $title, $des, $picUrl, $url);
		$this->items = $this->items . $ret;
	}
	
	public function getItems(){
		return $this->items;
	}
}

?>