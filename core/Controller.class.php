<?php
/**
 * ���п������Ļ���
 */

class Controller{
	/**
	 * ����ָ����ģ��ҳ��
	 * @param $page
	 * @param array $data 
	 */
	public function show($page,$data = array()){
		$pagePath = 'app/view/'.$page.'.php';
		//�ж�ҳ���Ƿ����
		if(file_exists($pagePath)){
			require_once $pagePath;
		}
	}
}