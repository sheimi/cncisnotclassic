<?php
/**
 * 
 * 此Controller主要负责课程相关书籍的增删查改 
 * @author Javoft
 */
class BooksController extends Controller
{
    private $commentPageSize = 2;
	public function actionAddbook()
	{
	    $bookName = $_REQUEST['title'];
        $bookCover = $_REQUEST['book_cover'];
        $author = $_REQUEST['author'];
        $publisher = $_REQUEST['publisher'];
        $pubdate = $_REQUEST['pubdate'];
        $price = $_REQUEST['price'];
        $isbn = $_REQUEST['isbn'];
        
	    $model = new Books;
	    
	    $cid = $_REQUEST['cid'];
	    
        //先添加一本书
		$memberId = Yii::app ()->user->getState ( 'user_id' );
		$bookModel = $model;
		$this->performAjaxValidation($model);
		$data = array (
			'book_name' => $bookName, 
		    'isbn' => $isbn,
		    'cover_path' => $bookCover,
			'provider' => $memberId, 
		    'author' => $author, 
		    'publisher' => $publisher,
		    'pubdate' => $pubdate,
		    'price' => $price
		);
		
		$bookModel->attributes = $data;
		
		if( $row = $bookModel->findByAttributes(array('isbn'=>$isbn) ) ) {
		    //已经有这本书
    		$bookId = $row->book_id;
    		//检查有没有此course_book关系
    		$data = array ('book_id' => $bookId, 'course_id' => $cid );
    		$courseBookModel = new CourseBook ();
    		
    		if($row = $courseBookModel->findByAttributes($data)){
    		    //如果已经有了cb关系，增加一条up-down  up
    		    $this->updown($memberId, $row->c_b_id, 'up' );
    		}else{
    		    $data = array ('book_id' => $bookId, 'course_id' => $cid );
    			$courseBookModel = new CourseBook ();
    			
    			$courseBookModel->attributes = $data;
    			if ($courseBookModel->save ())
    			{
    				//增加一条course_book关系的同时，也增加一条cb_up_down的记录
    				$this->updown($memberId, $courseBookModel->c_b_id, 'up' );
    			}
    		}
    		
		}else{
		    if($bookModel->save()){
		        $bookId = $bookModel->book_id;
    		    $cid = $_REQUEST['cid'];
    			$data = array ('book_id' => $bookId, 'course_id' => $cid );
    			$courseBookModel = new CourseBook ();
    			
    			$courseBookModel->attributes = $data;
    			
    			if ($courseBookModel->save ())
    			{
    				//增加一条course_book关系的同时，也增加一条cb_up_down的记录
    				$this->updown($memberId, $courseBookModel->c_b_id, 'up' );
    			}
		    }
		}
		$this->render ( 'addbook', array ('model' => $model ) );
	}
	
	private function updown($memberId, $c_b_id, $updown){
	    $data = array ('member_id' => $memberId, 'cb_id' => $c_b_id, 'updown' => 'up' );
		$cbudModel = new CbUpDown ();
		$cbudModel->attributes = $data;
		$row = $cbudModel->findByAttributes(array('member_id'=>$memberId, 'cb_id' => $c_b_id));
		if($row){
		   return $cbudModel->update();
		}else{
    		return $cbudModel->save ();
		}
	}
	
	protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='book-info')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
	
	public function actionDeletebook()
	{
		$this->render ( 'deletebook' );
	}
	
	public function actionEditbook()
	{
		$this->render ( 'editbook' );
	}
	
	public function actionIndex()
	{
		$this->render ( 'index' );
	}
	
	public function actionViewbook()
	{
		$memberId = Yii::app ()->user->getState ( 'user_id' );
		$bookId = $_REQUEST ['bid'];
		
		$row = Books::model ()->with ( array ('providerdetail' => array () ) )->with ( array ('courseBooks' => array () ) )->findByPk ( $bookId );
		
		//整理数据库中取出的数据
		$book ['book_id'] = $row->book_id;
		$book ['book_name'] = $row->book_name;
		$book ['comment'] = $row->comment;
		$book ['publisher'] = $row->publisher;
		$book ['author'] = $row->author;
		$book ['cover_path'] = $row->cover_path;
		$book ['pubdate'] = $row->pubdate;
		$book ['provider_id'] = $row->providerdetail->user_id;
		$book ['provider_name'] = $row->providerdetail->username;
		
		/**
		 * TODO 这里可以首先取出一部分书籍编辑者的信息显示，以鼓励大家共同编辑书籍
		 * @version 1.0 首先只显示出拥有这本书的人
		 * 需要取出有这本书的人
		 */
		$rows = Books::model ()->with ( 'bookowner' )->with ( 'bookowner.owner' )->findAll ( 'bookowner.book_id = :book_id', array (':book_id' => $bookId ) );
		
		//整理拥有此本书的用户的数据
		$ownerList = array ();
		foreach ( $rows as $row )
		{
			foreach ( $row->bookowner as $o )
			{
				$owner = array ();
				$owner ['owner_name'] = $o->owner->username;
				$owner ['owner_id'] = $o->owner->user_id;
				$owner ['avatar_path'] = $o->owner->avatar_path;
				$ownerList [] = $owner;
			}
		}
		
		
		//取出和这本书籍相关的课程
		$rows = Books::model ()
		->with ( 'courseBooks' )
		->with ( 'courseBooks.course' )->findAll ( 'courseBooks.book_id = :book_id', array (':book_id' => $bookId ) );
		
		//整理和书籍相关课程的数据
		$relCourseList = array ();
		foreach ( $rows as $row )
		{
			foreach ( $row->courseBooks as $r )
			{
				$relCourse = array ();
				$relCourse ['cb_id'] = $r->c_b_id;
				$relCourse ['course_id'] = $r->course->course_id;
				$relCourse ['course_name'] = $r->course->course_name;
				$relCourseList [] = $relCourse;
			}
		}
		
		
		
		//取出其他用户对此书的评论
		$commentList = $this->getComment($bookId, 0, $this->commentPageSize);
		
		//记录浏览历史
		$this->addBookViewHistory ( $memberId, $bookId );
		$this->render ( 'viewbook', array (
		'book' => $book, 
		'relCourse' => $relCourseList, 
		'ownerList' => $ownerList, 
		'bookComments' => $commentList, 
		'deps' => $deps,
		'commentPageSize' => $this->commentPageSize, 
		) );
	
	}
	
	//为书籍添加相关课程
	public function actionAddrelcourse($bookid, $courseid)
	{
		$memberId = Yii::app ()->user->getState ( 'user_id' );
		
		$cbModel = new CourseBook ();
		$data = array ('book_id' => $bookid, 'course_id' => $courseid, 'recommender_id'=>$memberId);
		$row = $cbModel->findByAttributes ( $data );
		if ($row)
		{
			//如果关系已经存在,则在cb_up_down中up一下
			$cbId = $row->c_b_id;
			$this->addUpdown($cbId, $memberId);
			echo '已经有人推荐过此课程';
		} else
		{
			//还没有人建立过此书和此课程的关系
			$cbModel->attributes = $data;
			if($cbModel->save() ){
			    $this->addUpdown($cbModel->c_b_id, $memberId);
			}
			echo '推荐成功';
		}
	}
	
	private function addUpdown($cbId, $memberId){
	    $udModel = new CbUpDown();
	    $udModel->attributes = array(
	    	'cb_id'=>$cbId, 
	        'member_id' => $memberId,
	        'updown'=>'up'
	    );
	    $udModel->save();
	}
	
	public function actionMorecomment(){
	    $bookId = $_REQUEST['bookid'];
	    $pageNum = $_REQUEST['pagenum'];
	    
	    $commentList = $this->getComment($bookId, $pageNum, $this->commentPageSize);
        echo json_encode($commentList);
	}
	
	public function actionCheckdupbook($isbn){
//	    $rows = Books::model()
//	    ->with('providerdetail')
//	    ->findByAttributes(array('isbn'=>$isbn));
//	    
//	    if(!$rows){
//	        //没有这条记录
//	    }else{
//	        //已经有这条记录
//	        echo json_encode($rows[0]->providerdetail);
//	    }
	}
	
	/**
	 * 在为书籍添加其他课程的时候，辅助
	 */
	public function actionAddRelHelper()
	{
		$act = $_REQUEST ['act'];
		
		switch ($act)
		{
			case 'deps' :
				break;
			case 'getmajor' :
				$depId = $_REQUEST ['depid'];
				$rows = Major::model ()->findAll ( array ('select' => 'major_name, major_id', 'condition' => "dep_id = '$depId'" ) );
				
				//整理数据
				$majors = array ();
				foreach ( $rows as $row )
				{
					$major = array ();
					$major ['major_name'] = $row->major_name;
					$major ['major_id'] = $row->major_id;
					
					$majors [] = $major;
				}
				echo json_encode ( $majors );
				break;
			case 'getcourse' :
				$majorid = $_REQUEST ['majorid'];
				$rows = Actualclass::model ()->findAll ( array ('select' => 'course_id', 'condition' => "major_id = $majorid" ) );
				
				$courseids = array ();
				foreach ( $rows as $row )
				{
					$courseids [] = $row->course_id;
				}
				
				$data = array ('course_id' => $courseids );
				$rows = Course::model ()->findAllByAttributes ( $data );
				
				//整理数据
				$courseList = array ();
				foreach ( $rows as $row )
				{
					$course = array ();
					$course ['course_id'] = $row->course_id;
					$course ['course_name'] = $row->course_name;
					
					$courseList [] = $course;
				}
				
				echo json_encode ( $courseList );
		}
	}
	
	public function actionChoosecourse()
	{
	    //取出学院列表$deps
		$rows = Departments::model ()->findAll ( array ('select' => 'dep_id, dep_name' ) );
		
		//整理数据
		$deps = array();
		foreach ( $rows as $row )
		{
			$dep = array ();
			$dep ['dep_id'] = $row->dep_id;
			$dep ['dep_name'] = $row->dep_name;
			
			$deps [] = $dep;
		}
	    $this->renderPartial('choosecourse', array(
	        'deps'=>$deps
	    ));
	}
	
	public function actionAddcomment()
	{
		$memberId = Yii::app ()->user->getState ( 'user_id' );
		$content = $_REQUEST ['content'];
		$bookId = $_REQUEST ['bookid'];
		if ($content && $bookId)
		{
			$bcModel = new Bookcomment ();
			$data = array ('book_id' => $bookId, 'user_id' => $memberId, 'content' => $content );
			$bcModel->attributes = $data;
			if ($bcModel->save ())
			{
				//成功
				$bcId = $bcModel->bookcomment_id;
				$row = Bookcomment::model ()->with ( 'user' )->with ( 'user.major' )->findByPk ( $bcId );
				
				$comment = array ();
				$comment ['content'] = $row->content;
				$comment ['username'] = $row->user->username;
				$comment ['user_id'] = $row->user->user_id;
				$comment ['avatar_path'] = $row->user->avatar_path;
				$comment ['add_time'] = $row->add_time;
				$comment ['major'] = $row->user->major->major_name;
				$comment ['star'] = $row->star;
				
				echo json_encode ( $comment );
			} else
			{
				//添加失败
			}
		} else
		{
		}
	}
	
	private function addBookViewHistory($memberId, $bookId)
	{
		//记录所有浏览历史，用户没浏览一次增加一条浏览记录，将来可能需要改成用户每天浏览一次增加一次，重复浏览不计算
		$bvhModel = new BvHistory ();
		
		$data = array ('user_id' => $memberId, 'book_id' => $bookId );
		$bvhModel->attributes = $data;
		$bvhModel->save ();
	
	}

	private function getComment($bookId, $pageNum, $pageSize){
	    //取出其他用户对此书的评论
		$rows = Bookcomment::model ()
		->with (array(
		        'user',
		        'user.major'
		    )
	    )
		->findAll( array(
			'condition'=>"book_id = $bookId",
		    'limit' => $pageSize + 1,
		    'offset' => $pageNum * $pageSize,
		    'order' => 'add_time DESC'
		));
		
	    //整理取出的书籍评论
		$commentList = array ();
		foreach ( $rows as $c )
		{
			$comment = array ();
			$comment ['content'] = $c->content;
			$comment ['username'] = $c->user->username;
			$comment ['user_id'] = $c->user->user_id;
			$comment ['avatar_path'] = $c->user->avatar_path;
			$comment ['add_time'] = $c->add_time;
			$comment ['major'] = $c->user->major->major_name;
			$comment ['star'] = $c->star;
			
			$commentList [] = $comment;
		}
		
		return $commentList;
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