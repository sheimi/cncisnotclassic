<?php

class AutocompleteController extends Controller
{
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
	public function actionAutobook()
	{
		$prefix = $_REQUEST ['q'];
		$criteria = new CDbCriteria ();
		$criteria->select = 'book_name'; // only select the 'title' column
		$criteria->condition = 'book_name LIKE :bn_prefix';
		$criteria->params = array (':bn_prefix' => "$prefix%" );
		$criteria->limit = 10;
		$rows = Books::model ()->findAll ( $criteria );
		foreach ( $rows as $row )
		{
			echo $row->book_name . "\n";
		}
	}

	public function actionAutocourse()
	{
		$prefix = $_REQUEST ['q'];
		$criteria = new CDbCriteria ();
		$criteria->select='course_name'; // only select the 'title' column
        $criteria->condition='course_name LIKE :cn_prefix';
        $criteria->params=array(':cn_prefix'=>"$prefix%");
        $criteria->limit = 10;
		$rows = Course::model()->findAll($criteria);
		foreach ( $rows as $row )
		{
			echo $row->course_name . "\n";
		}
	}

	public function actionAutoteacher()
	{
	    $prefix = $_REQUEST ['q'];
		$criteria = new CDbCriteria ();
		$criteria->select='teacher_name'; // only select the 'title' column
        $criteria->condition='teacher_name LIKE :tn_prefix';
        $criteria->params=array(':tn_prefix'=>"$prefix%");
        $criteria->limit = 10;
		$rows = Teacher::model()->findAll($criteria);
		foreach ( $rows as $row )
		{
			echo $row->teacher_name . "\n";
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