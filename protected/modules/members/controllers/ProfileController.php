<?php

class ProfileController extends Controller
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
		$this->render('edit');
	}

	public function actionIndex()
	{
		$this->render('index');
	}
	
	/**
	 * @author
	 * 这里展示他有的书籍
	 * 他推荐的书籍AND课程
	 * 他关注的课程
	 * 他的课程表
	 */
	public function actionView(){
	    $memberId = Yii::app()->user->getState('user_id');
	    //获取他有的书籍
	    $rows = Books::model()
	    ->findAll("provider = $memberId");
	    
	    //整理书籍数据
	    $bookList = array();
	    foreach ($rows as $row){
	        $book = array();
	        $book['book_name'] = $row->book_name;
	        $book['cover_path'] = $row->cover_path;
	        $book['book_id'] = $row->book_name;
	        $book['add_time'] = $row->add_time;
	        
	        $bookList[] = $book;
	    }
	    
	    //获取他为课程推荐推荐的书籍
//	    CourseBook::model()
//	    ->with()
//	    ->with()
//	    ->findAll();
	    
	    //获取他关注的课程
	    
	    $return = array(
	        'ownBookList' => $bookList,
	        'recommendBookList' => $recommendBookList,
	        'favCourseList' => $favCourseList
	    );
	    //获取他的课程表
	    $this->render('view', $return);
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