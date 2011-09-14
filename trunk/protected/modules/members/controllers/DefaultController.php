<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$this->render ( 'index' );
	}
//	public function filters(){
//	    return array('accessControl',);
//	}
//	
//	public function accessRules(){
//	    return array(
//	        array(
//	            'allow',
//	            'actions' => array('login', 'logout', 'register', 'getmajor', 'newuser'),
//	            'users' => array('*'),
//	        ),
//	        array(
//	            'deny',
//	            'actions' => array(),
//	            'users' => array('?')
//	        )
//	    );
//	}
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
		$this->render( 'register', array ('model' => $model, 'depList'=>$depList) );
	}
	
	public function actionNewuser()
	{
	    $email = $_POST['email'];
	    $username = $_POST['username'];
	    $grade = $_POST['grade'];
	    $major = $_POST['major'];
	    
	    if(isset($email) && isset($username) && isset($grade) && isset($major))
	    {
	        $row1 = Users::model()->findByAttributes(array(
	            'username'=>$username
	        ));
	        
	        $row2 = Users::model()->findByAttributes(array(
	            'email'=>$email
	        ));
	        
	        $msg = '';
	        if(sizeof($row2))
	        {
                $msg .= '邮箱已经被使用<br/>';
	        }
	        if( sizeof($row2)){
	            $msg .= '用户名已经被使用';
	        }
	        if ($msg != ''){
    	        $this->render('sendfinish', array(
    	            'msg'=>$msg
    	        ));
    	        Yii::app()->end();
	        }
	        
            $userpassword = $this->get_password();
            $attributes = array(
    	    	'major_id'=>$major,
    	    	'email'=>$email,
    	    	'grade'=>$grade,
    	        'password'=>md5($userpassword),
    	    	'username'=>$username,
    	    );
    	    
            $userModel = new Users;
            $userModel->attributes = $attributes;
            if($return = $this->sendPwd($username, $email, $userpassword)){
                if($userModel->save()){
                    $this->render('sendfinish', array('msg'=>'邮件发送完成<a href="http://smail.nju.edu.cn">到邮箱查看密码</a>'));
                }else{
                    $this->render('sendfinish', array('msg'=>$userModel->errors));
                }
            }else{
                $this->render('sendfinish', array('msg'=>$return));
            }
	    }else{
	        $this->redirect(BU . "/members/default/register");
	    }
    }

    function get_password( $length = 8 ) 
    { 
        $str = substr(md5(time()), 0, 6); 
        return $str; 
    }
    
    
    public function actionResendpwd($email)
    {
        $newPwd = $this->get_password();
        $model = new Users;
        $row = Users::model()->findByAttributes(array('email'=>$email));
        
        $username = $row->username;
        if($model->updateAll(array('password'=>md5($newPwd)), 'email=:email', array(':email'=>$email))){
            if($return = $this->sendPwd($username, $email, $newPwd) == true){
                $this->render('sendfinish', array(
                    'status'=>'success',
                    'msg'=>'邮件发送完成<a href="http://smail.nju.edu.cn">到邮箱查看密码</>'
                ));
            }else{
                $this->render('sendfinish', array(
                    'status'=>'fail',
                    'msg'=>$return
                ));
            }    
        }else{
            $this->render('sendfinish', array(
                    'status'=>'fail',
                    'msg'=>''
                ));
        }
    }
    
    public function actionSendsuccess(){
        
    }
    
    private function sendPwd($username, $email, $password){
        $mailer = Yii::createComponent('application.extensions.mailer.EMailer');
        $mailer->Host = 'smtp.163.com';
        $mailer->IsSMTP();
        $mailer->SMTPAuth = true;
        $mailer->From = 'njulilyadmin@163.com';
        $mailer->AddReplyTo('njulilyadmin@163.com');
        $mailer->AddAddress("$email@smail.nju.edu.cn");
        $mailer->FromName = 'njulilyadmin';
        $mailer->Username = 'njulilyadmin';    //这里输入发件地址的用户名
        $mailer->Password = 'llstudio@NJU109';    //这里输入发件地址的密码
//        $mailer->SMTPDebug = true;   //设置SMTPDebug为true，就可以打开Debug功能，根据提示去修改配置
        $mailer->CharSet = 'UTF-8';
        $mailer->Subject = Yii::t('demo', 'CNC注册邮件');
        $message = "感谢您注册CNC, 您的登录密码为：$password";
        $mailer->Body = $message;
        if ($mailer->Send()) {
        	return true;
        }else{
        	return $mailer->errors;
        }
//        require_once "mail.php";
//	    $from = "huatingzl@gmail.com";
//        $to = "$username <$email@smail.nju.edu.cn>";
//        $subject = "CNC注册邮件"; //邮件主题
//        $body = "您好，感谢您注册CNC，您的密码是：$password"; //邮件内容
//         
//        $host = "smtp.gmail.com";
//        $username = "huatingzl"; //gmail用户名
//        $password = "huating8232828"; //gmail密码
//        
//        $subject = "=?UTF-8?B?".base64_encode($subject)."?=";
//        
//        $headers = array (
//            'MIME-Version'=>'1.0',
//            'From' => $from,
//            'To' => $to,
//            'Subject' => $subject,
//            'Content-Type'=>'text/plain; charset=UTF-8',
//        );
//        
//        
//        $smtp = Mail::factory(
//            'smtp',
//            array (
//            'host' => $host,
//            'auth' => true,
//            'username' => $username,
//            'password' => $password
//            )
//        );
//        
//        $mail = $smtp->send($to, $headers, $body);
//        if (PEAR::isError($mail)) {
//            return $mail->getMessage();
//        } else {
//            return true;
//        }
        
    }
    public function actionCheckusername($username)
    {
        $rows = Users::model()
        ->findAll('username=:uname', array(':uname'=>$username));
        
        if(sizeof($rows) == 0){
            echo 'true';
        }else{
            echo 'false';
        }
    }
    
    public function actionCheckemail($email)
    {
        $rows = Users::model()
        ->findAll('email=:email', array(
        	':email'=>$email
        ));
        
        if(sizeof($rows) == 0){
            echo 'true';
        }else{
            echo 'false';
        }
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
	
	public function actionGetmajor($dep_id){
	    $rows = Major::model()
	    ->findAll('dep_id = :dep_id', array(':dep_id'=>$dep_id));
	    
	    $majors = array();
	    foreach ($rows as $row)
	    {
	        $major = array();
	        $major['name'] = $row->major_name;
	        $major['id'] = $row->major_id;
	        $majors[] = $major;
	    }
	    echo json_encode ($majors);
	}
	
	private function loadUsersModel($id)
	{
		$model = Users::model ()->findByPk ( ( int ) $id );
		if ($model === null)
			throw new CHttpException ( 404, 'The requested page does not exist.' );
		return $model;
	}
}