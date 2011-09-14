<?php

class DefaultController extends Controller
{
  public function init() {
		if (Yii::app()->user->id != 'sheimi') {
			$this->redirect ( array ('/') );
			//throw new CHttpException(404,'No such page');
		}
    parent::init();
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/admin.css');
  }
	public function actionIndex()
	{
		$this->render('index');
	}
}
