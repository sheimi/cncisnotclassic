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
        $updownModel = new CbUpDown();
        
        //书籍课程关系的Id
        $cbId = $_POST['cbid'];
        $updown = $_POST['updown'];
        
        $rows = $updownModel
        ->find(
        	'member_id = :member_id AND cb_id = :cb_id',
            array(
                ':member_id'=>$memberId,
                ':cb_id'=>$cbId
            )
        );
        
        if($updown != 'up' && $updown){
            $updow = 'up';
        }
        
        if(sizeof($rows) != 0){
            //已经评价过，不能重复评价
        }else{
            $data = array(
                'member_id'=>$memberId,
                'cb_id'=>$cbId,
                'updow'=>$updow
            );
            $updownModel->attributes = $data();
            if($updownModel->save()){
                //添加数据成功
            }else{
                //添加数据失败
            }
        }
	}
	
	public function actionDown(){
	    
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