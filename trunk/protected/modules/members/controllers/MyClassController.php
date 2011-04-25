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
	    $myClassId = $_POST['id'];
	    $customContent = $_POST['value'];
	    
	    $myClassModel = new Myclass();
	    $data = array(
	        'custom' => $customContent
	    );
	   if($myClassModel->updateByPk($myClassId, $data)) {
	       echo $customContent;
	   }else{
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
	
	/**
	 * @author Javoft
	 * 根据用户的院系信息，初始化用户的课表
	 */
	public function actionInitclass(){
	    $memberId = Yii::app()->user->getState('user_id');
	    //查询出用户所属的院系
	    $user = Users::model()->findByPk($memberId);
	    $majorId = $user->major_id;
	    $grade = $user->grade;
	    //获取该院系的课程
	    $rows = Actualclass::model()
	    ->with('course')
	    ->findAll(array(
    	    'select'=>'class_id',
    	    'condition' =>"major_id = '$majorId' AND grade = $grade",
	        )
	    );
	    
	    //整理数据
	    $myClassList = array();
	    foreach ($rows as $row){
	        $myClass = array();
	        $myClass['actualclass_id'] = $row->class_id;
	        $myClass['class_name'] = $row->course->course_name;
	        $myClass['member_id'] = Yii::app()->user->getState('user_id');
	        foreach ($row->timeSites as $timeSite){
	            $myClass['day'] = $timeSite->day_of_week;
	            $myClass['classroom'] = $timeSite->classroom;
	            $myClass['campus'] = $timeSite->campus;
	            
	            if(trim($timeSite->week_info) == '单周'){
	                $myClass['week_info'] = 'single';
	            }else if(trim($timeSite->week_info) == '双周'){
	                $myClass['week_info'] = 'double';
	            }else{
	                $myClass['week_info'] = 'both';
	            }
	            
	            for($i = $timeSite->begin_time; $i <= $timeSite->end_time; $i++){
	                $myClass['time'] = $i;
	                $myClassList[] = $myClass;
	            }
	        }
	    }
	    
	    //上面的数据插入到myClass表中
	    
	    foreach ($myClassList as $myClass){
	        $myClassModel = new Myclass();
	        $myClassModel->attributes = $myClass;
	        $myClassModel->save($myClass);
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