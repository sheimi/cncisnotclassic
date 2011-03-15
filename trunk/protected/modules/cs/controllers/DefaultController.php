<?php
/**
 * @author Javoft
 * 课程搜索首页，也是用户登录的首页
 *
 */
class DefaultController extends Controller
{
	public function actionIndex()
	{
		$this->render ( 'index' );
	}
	
	public function accessRules()
	{
	    
		return array (
		    //这只该Controller下面对应的所有Action未登录用户都不能访问
		    array (
		    'deny', 
		    'actions' => array (), 
		    'users' => array ('?')),
	    );
	}

	// Uncomment the following methods and override them if needed
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'accessControl',
		);
	}
	

/*
	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}