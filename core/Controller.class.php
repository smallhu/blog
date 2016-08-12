<?php
/**
 * 所有控制器的基类
 */

class Controller{
	/**
	 * 加载指定的模板页面
	 * @param $page
	 * @param array $data 
	 */
	public function show($page,$data = array()){
		$pagePath = 'app/view/'.$page.'.php';
		//判断页面是否存在
		if(file_exists($pagePath)){
			require_once $pagePath;
		}
	}
}