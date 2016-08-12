<?php
/**
 * URL重写类
 */

class App{
	//一定要定义成静态方法  不然下面静态方法不能使用
	protected static $controller = 'home';
	protected static $method = 'index';
	protected static $parms = array(); 
	
	/**
	 * url 重写路由方法
	 */
	private static function parseUrl(){
		//判断是否传了URL
		if(isset($_GET['url'])){
			//获取url
			$pathUrl = $_GET['url'];
			$url = explode('/',$pathUrl);
			
			//获取控制器
			if(isset($url[0])){
				self::$controller = $url[0];
				unset($url[0]);
			}
			
			//获取方法
			if(isset($url[1])){
				self::$method = $url[1];
				unset($url[1]);
			}
			
			//判断是否含有其他的参数
			if(isset($url)){
				//数组重置下表并获取其他参数
				self::$parms = array_values($url);
			}
		}
	}
	
	//执行 项目入口方法
	public static function Run(){
		self::parseUrl();
		//获取控制器路径
		$controller_dir = 'app/controller/'.self::$controller.'.class.php';
		
		//判断控制器文件是否存在
		if(file_exists($controller_dir)){
			//实例化控制器
			$c = new self::$controller;
		}else{
			throw new MyException('控制器不存在！');
		}
		
		//执行方法
		if(method_exists($c, self::$method)){
			$m = self::$method;	
			//判断是否有其他参数
			$num = count(self::$parms);
			//用于存储处理好的参数     参数名称维数组下标    参数的值为数组的元素值  
			$new_parms = array();
			
			//begin暂时使用  以后可能修改 
			if($num>0){
				//传递参数
				if($num === 1){
					//判断是否是数值
					if(is_numeric(self::$parms[0])){
						$new_parms['id'] = self::$parms[0];
					}else{
						throw new MyException('非法参数！');
					}
				}else if($num>1){
					//判断传递参数名称和值是否是2的倍数
					if($num % 2 === 0){
						//处理参数
						for($i = 0; $i < $num; $i += 2){
							$new_parms[self::$parms[$i]] = self::$parms[$i+1];
						}
					}else{
						throw new MyException('非法参数！');
					}
				}
			}
			//begin暂时使用  以后可能修改 
			$c->$m($new_parms);	
		}else{
			throw new MyException('方法不存在！');
		}
	}
	
	/**
	 * 自动加载类的方法
	 */
	public static function myAutoLoader($className){
		//控制器所在的目录
		$controller = 'app/controller/'.$className.'.class.php';
		//模型所在目录
		$model = 'app/model/'.$className.'.class.php';
		//项目的核心目录
		$core = 'core/'.$className.'.class.php';
		
		//判断类文件在那个目录中
		if(file_exists($controller)){
			require_once $controller;
		}else if(file_exists($model)){
			require_once $model;
		}else if(file_exists($core)){
			require_once $core;
		}else{
			throw new MyException('要加载的类文件不存在！');
		}
	}
}