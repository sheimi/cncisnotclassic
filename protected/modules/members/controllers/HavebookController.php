<?php

class HavebookController extends Controller
{
    public function accessRules()
	{
		return array (
		    //这只该Controller下面对应的所有Action未登录用户都不能访问
		    array (
		    'deny', 
		    'actions' => array (), 
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
	public function actionAdd()
	{
	    $memberId = Yii::app()->user->getState('user_id');
	    $bookId = $_REQUEST['bookid'];
	    $access = $_REQUEST['access'];
	    if(!in_array($access, array('borrow', 'sell', 'private'))){
	        $access = 'borrow';
	    }
	    
	    if(!$access){
	        $access = 'borrow';
	    }
	    if(!$memberId || !$bookId || !$access){
	        //请求失败
	        echo '对不起，请求失败！';
	    }else {
	        
	        $data = array(
	            'owner_id' => $memberId,
	            'book_id' => $bookId,
	            'access' => $access
	        );
	        
	        $rows = OwnerBook::model()
	        ->findAllByAttributes(array(
	        	'owner_id' => $memberId,
	            'book_id' => $bookId
	        )
	        );
	        
	        if(!$rows){
    	        $obModel = new OwnerBook();
    	        $obModel->attributes = $data;
    	        if($obModel->save()){
    	            //添加成功
    	            echo '标记成功';
    	        }else{
    	            //添加失败
    	            echo '标记失败';
    	        }
	        }else{
	            //这里只有一条记录
	            if($rows[0]->access == $access){
                    echo '你已经标记过';
	            }else{
	                $data = array(
        	            'access' => $access
	                );
	                if(OwnerBook::model()->updateAll($data, 'owner_id = :mid AND book_id = :bid', array(':mid'=>$memberId, ':bid'=>$bookId))){
	                    echo '更新状态为' . $access;
	                }
	                echo '';
	            }
	        }
	    }
	}

	public function actionDelete()
	{
		$this->render('delete');
	}

	public function actionEdit()
	{
		$this->render('edit');
	}

	public function actionIndex()
	{
		$this->render('index');
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