<?php

class LikecourseController extends Controller
{
    
    /**
     * @author Javoft
     * 在点击关注课程之后，添加记录
     */
	public function actionAdd()
	{
	    //添加一个 喜欢课程关系
	    $memberId = Yii::app()->user->getState('user_id');
	    $courseId = $_GET['cid'];
	    $likeCourseModel = new LikeCourse();
	    
	    $likeCourseModel->attributes = array(
	        'member_id' => $memberId,
	        'course_id' => $courseId
	    );
	    
	    if($likeCourseModel->save()){
	        //插入成功
	    }else{
	        //插入失败
	    }
		$this->render('add');
	}

	
	/**
	 * @author Javoft
	 * @todo 取消关注的课程 ，同follow和unfollow
	 */
	public function actionDelete()
	{
		$this->render('delete');
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