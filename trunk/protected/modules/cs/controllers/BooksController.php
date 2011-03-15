<?php
/**
 * 
 * 此Controller主要负责课程相关书籍的增删查改 
 * @author Javoft
 */
class BooksController extends Controller
{
	public function actionAddbook()
	{
		$this->render('addbook');
	}

	public function actionDeletebook()
	{
		$this->render('deletebook');
	}

	public function actionEditbook()
	{
		$this->render('editbook');
	}

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionViewbook()
	{
		$this->render('viewbook');
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