<?php

class DefaultController extends Controller
{
  public function init() {
    parent::init();
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/admin.css');
  }
	public function actionIndex()
	{
		$this->render('index');
	}
}
