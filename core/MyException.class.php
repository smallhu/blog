<?php
/**
 * �����쳣���
 */
class MyException extends Exception{
	
	public function showError($message){
		//��ȡ�쳣���·��
		$errorPath = 'app/view/error/error.php';
		//�ж��Ƿ����
		if(file_exists($errorPath)){
			require_once $errorPath;
		}
	}
}