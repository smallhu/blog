<?php
/**
 * 前台控制器
 */


class home{
	public function index($params=array()){
		echo '这是前台Home控制器中的index方法'.'<br/>';
		echo "<pre/>";
		print_r($params);
	}
}