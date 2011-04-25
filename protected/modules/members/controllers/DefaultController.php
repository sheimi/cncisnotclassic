<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$this->render ( 'index' );
	}
	public function filters(){
	    return array('accessControl',);
	}
	
	public function accessRules(){
	    return array(
	        array(
	            'allow',
	            'actions' => array('login', 'logout', 'register', 'getmajor'),
	            'users' => array('*'),
	        ),
	        array(
	            'deny',
	            'actions' => array(),
	            'users' => array('?')
	        ),
	        
	    );
	}
	public function actionLogin()
	{
		$model = new LoginForm ();
		if (isset ( $_POST ['LoginForm'] ))
		{
			$model->attributes = $_POST ['LoginForm'];
			if ($model->validate () && $model->login ())
			{
				//登陆成功，跳转到课程搜索首页
				$this->redirect ( Yii::app ()->homeUrl );
				return;
			}
		}
		
		$this->render ( 'login', array ('model' => $model ) );
	}
	
	public function actionLogout()
	{
		Yii::app ()->user->logout ();
		$this->redirect ( Yii::app ()->homeUrl );
	}
	
	public function actionRegister()
	{
		$model = new Users ();
		if (isset ( $_POST ['Users'] ))
		{
			$model->attributes = $_POST ['Users'];
			if ($model->save ())
				$this->redirect ( array ('profile', 'id' => $model->user_id ) );
		}
		//获取专业列表
		$rows = Departments::model()->findAllBySql('select dep_id, dep_name from departments');
		
		$depList = array();
		foreach($rows as $row){
		    $dep = array();
		    $dep['dep_id'] = $row->dep_id;
		    $dep['dep_name'] = $row->dep_name;
		    $depList[] = $dep;
		}
		$this->render ( 'register', array ('model' => $model, 'depList'=>$depList) );
	}
	
	public function actionProfile()
	{
		$this->render ( 'profile');
	}
	
	public function actionEdit($id)
	{
		$model = $this->loadUsersModel ( $id );
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if (isset ( $_POST ['Users'] ))
		{
			$model->attributes = $_POST ['Users'];
			if ($model->save ())
				$this->redirect ( array ('profile', 'id' => $model->user_id ) );
		}
		$this->render ( 'edit', array ('model' => $model ) );
	}
	
	public function actionGetmajor(){
	    
	}
	
	private function loadUsersModel($id)
	{
		$model = Users::model ()->findByPk ( ( int ) $id );
		if ($model === null)
			throw new CHttpException ( 404, 'The requested page does not exist.' );
		return $model;
	}
}