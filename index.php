<?php
/**
 * 项目前台入口文件   单一入口
 * User xiaohu 
 */
require_once 'core/App.class.php';

//注册一个用户自定义的自动加载类方法
spl_autoload_register(array('App','myAutoLoader'));

try{
	App::Run();
}catch(Exception $e){
	$e->showError($e->getMessage());
}

//网站首页 home/index index()方法查询所有需要的数据 然后将这些数据发送到我们相应的页面中(view)
//实现一个加载相应的页面的方法并且传递数据到页面中


//echo $_GET['url'];exit;
//包含控制器类
//require_once 'app/controller/home.class.php'; 
//
////接收两个参数 controller控制器名称和method控制器中的方法名称两个参数
//$controller = isset($_GET['controller']) ? tirm($_GET['controller']) : 'home';
//$method = isset($_GET['method']) ? tirm($_GET['method']) : 'index';
//
////加载指定控制器中的指定方法
////实例化控制器类
//$c = new $controller;
////调用控制器中的方法
//$c->$method();