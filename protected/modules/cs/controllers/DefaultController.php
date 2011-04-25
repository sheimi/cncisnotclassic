<?php
/**
 * @author Javoft
 * 课程搜索首页，也是用户登录的首页
 *
 */
class DefaultController extends Controller
{
	public function actionIndex()
	{
	    //取出热门书籍
	    $rows = CbUpDown::model()
	    ->with('cb.course')
	    ->with('cb.book')
	    ->findAll();
	    
	    //整理数据
	    $cbList = array();
	    foreach ($rows as $row){
	        $cb = array();
	        $course = array();
	        $book = array();
	        $course['course_id'] = $row->cb->course->course_id;
	        $course['course_name'] = $row->cb->course->course_name;
	        
	        $book['book_id'] = $row->cb->book->book_id;
	        $book['book_name'] = $row->cb->book->book_name;
	        $book['cover_path'] = $row->cb->book->cover_path;
	        
	        $cb['course'] = $course;
	        $cb['book'] = $book;
	        
	        $cbList[] = $cb;
	    }
	       
		$this->render ( 
			'index',
		    array(
		        'hotbookList'=>$cbList,
		    )
		);
	}
	
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
	

/*
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