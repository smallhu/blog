<?php
/**
 * 错误异常输出
 */
class MyException extends Exception{
	
	public function showError($message){
		//获取异常输出路径
		$errorPath = 'app/view/error/error.php';
		//判断是否存在
		if(file_exists($errorPath)){
			require_once $errorPath;
		}
	}
}