<?php
class DefaultController extends Controller
{
	public function actionIndex()
	{
		//        $dataProvider = new CActiveDataProvider('Users');
		//        $this->render('index', array('dataProvider' => $dataProvider));
		if (Yii::app ()->user->isGuest)
		{
			$this->redirect ( array ('/members/default/login' ) );
		} else
		{
			$this->redirect ( array ('/cs' ) );
		}
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionRegister()
	{
		$model = new Users ();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if (isset ( $_POST ['Users'] ))
		{
			$model->attributes = $_POST ['Users'];
			if ($model->save ())
				$this->redirect ( array ('profile', 'id' => $model->user_id ) );
		}
		$this->render ( 'register', array ('model' => $model ) );
	}
	
	public function actionProfile($id)
	{
		$this->render ( 'profile', array ('model' => $this->loadUsersModel ( $id ) ) );
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
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
	
	/**
	 * show log in page and process login request
	 */
	public function actionLogin()
	{
		$model = new LoginForm ();
		// uncomment the following code to enable ajax-based validation
		/*
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form-login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        */
		
		//如果已经登陆，则跳转到课程搜索页面
		if (! Yii::app ()->user->isGuest)
		{
			$this->redirect ( array ('/cs' ) );
		}
		
		if (isset ( $_POST ['LoginForm'] ))
		{
			$model->attributes = $_POST ['LoginForm'];
			if ($model->validate () && $model->login ())
			{
				//登陆成功，跳转到课程搜索首页
				$this->redirect ( Yii::app ()->user->returnUrl );
				return;
			}
		}
		$this->render ( 'login', array ('model' => $model ) );
	}
	/**
	 * Process log out action
	 */
	public function actionLogout()
	{
		Yii::app ()->user->logout ();
		$this->redirect ( Yii::app ()->homeUrl );
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadUsersModel($id)
	{
		$model = Users::model ()->findByPk ( ( int ) $id );
		if ($model === null)
			throw new CHttpException ( 404, 'The requested page does not exist.' );
		return $model;
	}

	// Uncomment the following methods and override them if needed
/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'accessControl',
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