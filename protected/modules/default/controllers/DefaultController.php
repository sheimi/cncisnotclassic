<?php
/**
 * 
 * @author Javoft
 * Default为网站门户，现在所有用户需要登录才能使用系统，所以Controller仅仅
 * 在用户已经登录的时候，将其送至课程搜索首页，如果为登陆，则送至登陆页面。
 * 
 * 在后期如果要做一个不需要登陆的门户，这可以在default module中实现。
 */
class DefaultController extends Controller
{
	public function actionIndex()
	{
		if (Yii::app ()->user->isGuest)
		{
			$this->redirect ('index.php?r=members/default/login' );
		} else
		{
			$this->redirect ( 'index.php?r=cs' );
		}
	}

	// Uncomment the following methods and override them if needed
/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

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