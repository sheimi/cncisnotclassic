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
	    $courseId = $_REQUEST['cid'];
	    $memberId = Yii::app()->user->getState('user_id');
	    $star = $_REQUEST['star'];
	    
	    //检查是否已经标记过
	    $row = LikeCourse::model()
	    ->find('course_id = :cid AND member_id = :mid', array(':cid'=>$courseId, ':mid'=>$memberId));
	    
	    $likeCourseModel = new LikeCourse();
	    if(sizeof($row) == 0){
	        //没有记录
    	    
    	    $likeCourseModel->attributes = array(
    	        'member_id' => $memberId,
    	        'course_id' => $courseId,
    	        'star' => $star,
    	    );
    	    
    	    if($likeCourseModel->save()){
    	        //插入成功
    	        echo 'success';
    	    }else{
    	        //插入失败
    	        echo 'fail';
    	    }
	    }else{
	        //已经标记过喜欢
	        $rows = $likeCourseModel->findAllByAttributes(array(
    	        'member_id' => $memberId,
    	        'course_id' => $courseId,
    	    ));
    	    
    	    foreach ($rows as $row) {
    	        $row->attributes = array(
    	                'star' => $star
                );
                $row->save();
    	    }
    	    echo "已经标记为喜欢  $star 星";
    	        
	    }
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