<?php

class SiteController extends Controller
{
    public function accessRules()
	{
		return array (
		    //这只该Controller下面对应的所有Action未登录用户都不能访问
		    array (
		    'deny', 
		    'actions' => array ('feedback', 'index'), 
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
	
	public function actionIndex()
	{
		$this->render ( 'index' );
	}
	
	public function actionAbout()
	{
		$this->render ( 'about' );
	}
	
	public function actionContactus()
	{
		$this->render ( 'contactus' );
	}
	public function actionFeedback(){
	    $pageSize = 5;
	    if(isset($_GET['page']) && is_numeric($_GET['page']) ){
	        $page = $_GET['page'];
	    }else{
	        $page = 1;
	    }
	    if($_POST['content']){
	        $memberId = Yii::app()->user->getState('user_id');
	        $feedbackModel = new Feedback();
	        $feedbackModel->attributes = array(
	            'content'=>$_POST['content'],
	            'member_id'=>$memberId
	        );
	        
	        if($feedbackModel->save()){
	            ;
	        }else{
	            ;
	        }
	    } 
	    
        $rows = Feedback::model()
        ->with('member')
        ->findAll(array('limit'=>$pageSize, 'offset'=>($page-1)*$pageSize, 'order'=>'time desc'));
        
        $row = Yii::app()->db->createCommand('SELECT COUNT(*) total FROM feedback')->queryAll(); 
        $total = $row[0]['total'];
        
        $feedbacks = array();
        if(sizeof($rows) > 0)
        foreach ($rows as $row)
        {
            $feedback = array();
            $feedback ['username'] = $row->member->username;
            $feedback ['content'] = $row->content;
            $feedback ['time'] = $row->time;
            
            $feedbacks [] = $feedback;
        }
        
        $totalPage = (int)($total/$pageSize);
        if($total%$pageSize != 0)
            $totalPage += 1;
       
	    $this->render('feedback', array(
	        'feedbacks'=>$feedbacks,
	        'page'=>$page,
	        'totalPage'=>$totalPage,
	        'pageSize'=>$pageSize
	    ));
	}

}