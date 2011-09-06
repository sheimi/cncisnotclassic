<?php

class CbupdownController extends Controller
{
	public function actionEdit()
	{
		$this->render('edit');
	}

	public function actionIndex()
	{
		$this->render('index');
	}
	
	function actionUp(){
	    $memberId = Yii::app()->user->getState('user_id');
        $cbId = $_REQUEST['cbid'];
	    echo $this->upCourseBook($memberId, $cbId, 'up');
	}
	
	public function actionDown(){
	    $memberId = Yii::app()->user->getState('user_id');
        $cbId = $_REQUEST['cbid'];
	    echo $this->downCourseBook($memberId, $cbId,'down');
	}
	
	private function upCourseBook($memberId, $cbId, $updown){
	    $memberId = Yii::app()->user->getState('user_id');
        $updownModel = new CbUpDown();
	
        if($updown != 'up' && $updown){
            $updow = 'up';
        }
        
        $rows = $updownModel
        ->findByAttributes(
            array(
                'member_id'=>$memberId,
                'cb_id'=>$cbId
            )
        );
        
        
        if($rows){
            //已经评价过，不能重复评价
            if($rows->updown != $updown){
                $rows->attributes = array(
                    'updown' => $updown
                );
                $rows->save();
            }
            echo $updown;
        }else{
            $data = array(
                'member_id'=>$memberId,
                'cb_id'=>$cbId,
                'updown'=>$updow
            );
            $updownModel->attributes = $data;
            
            if($updownModel->save()){
                //添加数据成功
                return 'success';
            }else{
                //添加数据失败
                return 'fail';
            }
        }
	}
	
	private function downCourseBook($memberId, $cbId, $updown){
	    return $this->upCourseBook($memberId, $cbId, 'down');
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