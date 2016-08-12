<?php
/**
 * URL��д��
 */

class App{
	//һ��Ҫ����ɾ�̬����  ��Ȼ���澲̬��������ʹ��
	protected static $controller = 'home';
	protected static $method = 'index';
	protected static $parms = array(); 
	
	/**
	 * url ��д·�ɷ���
	 */
	private static function parseUrl(){
		//�ж��Ƿ���URL
		if(isset($_GET['url'])){
			//��ȡurl
			$pathUrl = $_GET['url'];
			$url = explode('/',$pathUrl);
			
			//��ȡ������
			if(isset($url[0])){
				self::$controller = $url[0];
				unset($url[0]);
			}
			
			//��ȡ����
			if(isset($url[1])){
				self::$method = $url[1];
				unset($url[1]);
			}
			
			//�ж��Ƿ��������Ĳ���
			if(isset($url)){
				//���������±���ȡ��������
				self::$parms = array_values($url);
			}
		}
	}
	
	//ִ�� ��Ŀ��ڷ���
	public static function Run(){
		self::parseUrl();
		//��ȡ������·��
		$controller_dir = 'app/controller/'.self::$controller.'.class.php';
		
		//�жϿ������ļ��Ƿ����
		if(file_exists($controller_dir)){
			//ʵ����������
			$c = new self::$controller;
		}else{
			throw new MyException('�����������ڣ�');
		}
		
		//ִ�з���
		if(method_exists($c, self::$method)){
			$m = self::$method;	
			//�ж��Ƿ�����������
			$num = count(self::$parms);
			//���ڴ洢����õĲ���     ��������ά�����±�    ������ֵΪ�����Ԫ��ֵ  
			$new_parms = array();
			
			//begin��ʱʹ��  �Ժ�����޸� 
			if($num>0){
				//���ݲ���
				if($num === 1){
					//�ж��Ƿ�����ֵ
					if(is_numeric(self::$parms[0])){
						$new_parms['id'] = self::$parms[0];
					}else{
						throw new MyException('�Ƿ�������');
					}
				}else if($num>1){
					//�жϴ��ݲ������ƺ�ֵ�Ƿ���2�ı���
					if($num % 2 === 0){
						//�������
						for($i = 0; $i < $num; $i += 2){
							$new_parms[self::$parms[$i]] = self::$parms[$i+1];
						}
					}else{
						throw new MyException('�Ƿ�������');
					}
				}
			}
			//begin��ʱʹ��  �Ժ�����޸� 
			$c->$m($new_parms);	
		}else{
			throw new MyException('���������ڣ�');
		}
	}
	
	/**
	 * �Զ�������ķ���
	 */
	public static function myAutoLoader($className){
		//���������ڵ�Ŀ¼
		$controller = 'app/controller/'.$className.'.class.php';
		//ģ������Ŀ¼
		$model = 'app/model/'.$className.'.class.php';
		//��Ŀ�ĺ���Ŀ¼
		$core = 'core/'.$className.'.class.php';
		
		//�ж����ļ����Ǹ�Ŀ¼��
		if(file_exists($controller)){
			require_once $controller;
		}else if(file_exists($model)){
			require_once $model;
		}else if(file_exists($core)){
			require_once $core;
		}else{
			throw new MyException('Ҫ���ص����ļ������ڣ�');
		}
	}
}