<?php

class MyClassController extends Controller
{
	public function actionAdd()
	{
		$this->render('add');
	}

	public function actionDelete()
	{
		$this->render('delete');
	}

	public function actionEdit()
	{
	    $myClassId = $_REQUEST['id'];
	    $event_title = $_REQUEST['event_title'];
	    $event_place = $_REQUEST['event_place'];
	    
	    $data = array(
	        'class_name' => $event_title,
	        'classroom' => $event_place
	    );
	    
	   if(Myclass::model()->updateByPk($myClassId, $data)) {
	       echo json_encode(array(
	           'status' => 'success',
	           'event_title' => $event_title,
	           'event_place' => $event_place
	       ));
	       
	   }else{
	       echo 'error';
	   }
	}

	/**
	 * 根据用户信息获取用户课表
	 * 状体类型：
	 * 		1、 没有填写院系信息，引导填写
	 * 		2、 没有建立自己的，没有建立自己的课表，系统提示为系统生成课表，建议生产成自己的可表
	 * 		3、 已经建立，显示之，并且可以恢复默认课表
	 */
	public function actionIndex()
	{
	    $userId = Yii::app()->user->getState('user_id');
	    
	    $user = Users::model()->findByPk($userId);
	    if($user->major_id){
	        //已经填写了 院系信息
	        $rows = Myclass::model()
	        ->findAll('member_id = :member_id', array(':member_id'=>$userId));
	        if(sizeof($rows) != 0){
	            //如果取出了结果，课表已经初始化
	            $myClassList = array();
	            foreach ($rows as $c){
	                $myClass = array();
	                $myClass['myclass_id'] = $c->myclass_id;
	                $myClass['class_name'] = $c->class_name;
	                $myClass['classroom'] = $c->classroom;
	                $myClass['custom'] = $c->custom;
	                $myClass['time'] = $c->time;
	                $myClass['week_info'] = $c->week_info;
	                $myClass['day'] = $c->day;
	                $myClass['actualclass_id'] = $c->actualclass_id;
	                
                    //position 表示课程在课表中的显示位置
                    $postion = $myClass['day'] - 1 + ($myClass['time'] - 1) * 7;
                    $myClassList[$postion] = $myClass;
	            }
	            $return = $myClassList;
	        }else{
	            //如果没有取出结果，说明还未初始化课表
	            echo "actionInitclass";
	            $this->actionInitclass();
	            $return = '还未初始化可表';
	        }
	    }else{
	        //没有填写院系信息
	        $errorMsg[] = '没有填写院系信息，请先完善个人信息再使用此功能。';
	    }
	    
	    $this->render('index', array(
	    'errorMsg'=>$errorMsg,
	    'return'=>$return,
	    ));
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