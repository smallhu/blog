<?php
class test{
	public function index($params=array()){
		echo '这是前台test控制器中的index方法'.'<br/>';
		echo "<pre/>";
		print_r($params);
	}
}