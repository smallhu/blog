<?php
/**
 * ��Ŀǰ̨����ļ�   ��һ���
 * User xiaohu 
 */
require_once 'core/App.class.php';

//ע��һ���û��Զ�����Զ������෽��
spl_autoload_register(array('App','myAutoLoader'));

try{
	App::Run();
}catch(Exception $e){
	$e->showError($e->getMessage());
}

//��վ��ҳ home/index index()������ѯ������Ҫ������ Ȼ����Щ���ݷ��͵�������Ӧ��ҳ����(view)
//ʵ��һ��������Ӧ��ҳ��ķ������Ҵ������ݵ�ҳ����


//echo $_GET['url'];exit;
//������������
//require_once 'app/controller/home.class.php'; 
//
////������������ controller���������ƺ�method�������еķ���������������
//$controller = isset($_GET['controller']) ? tirm($_GET['controller']) : 'home';
//$method = isset($_GET['method']) ? tirm($_GET['method']) : 'index';
//
////����ָ���������е�ָ������
////ʵ������������
//$c = new $controller;
////���ÿ������еķ���
//$c->$method();