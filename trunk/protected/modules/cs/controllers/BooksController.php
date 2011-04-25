<?php
/**
 * 
 * 此Controller主要负责课程相关书籍的增删查改 
 * @author Javoft
 */
class BooksController extends Controller
{
	public function actionAddbook()
	{
	    $memberId = Yii::app()->user->getState('user_id');
	    $book = $_POST['book'];
	    var_dump($book);
	    $cid = $_REQUEST['cid'];
	    $access = $_REQUEST['access'];
	    if('havent' != $access && !in_array($access , array('borrow', 'sell', 'private'))){
	        $access = 'borrow';
	    }
	    var_dump($cid);
	    if(!$cid){
	        //如果没有cid，非法进入，转到首页
	        $this->redirect (Yii::app()->request->baseUrl);
	    }
	    if(!$book || !$cid){
	        echo 'need more data';
	        $courseId = $_REQUEST['cid'];
	        $row = Course::model()
	        ->findByPk($courseId);
	        $course['course_name'] = $row->course_name;
	        $course['course_id'] = $row->course_id;
	        $this->render(
	        	'addbook',
	            array(
	                'course'=>$course,
	            )
	        );
	    }else{
	        echo 'data enough';
	        //先添加一本书
	        $memberId = Yii::app()->user->getState('user_id');
    	    $data = array(
    	        'book_name' => $book['name'],
    	        'provider' => $memberId,
    	        'cover_provider' => $memberId,
    	        'author' => $book['author'],
    	        'publisher' => $book['publisher'],
    	        'comment' => $book['comment']
    	    );
    	    $bookModel = new Books();
    	    $bookModel->attributes = $data;
    	    
    	    if($bookModel->save()){
    	        echo 'book saved';
        	    $data = array(
        	        'book_id' => $bookModel->book_id,
        	        'course_id' => $cid
        	    );
        	    $courseBookModel = new CourseBook();
        	    $courseBookModel->attributes = $data;
        	    if($courseBookModel->save()){
        	        echo 'course book saved';
        	        //增加一条owner_book记录
        	        if($access != 'havent'){
        	            $obModel = new OwnerBook();
        	            $data = array(
        	                'owner_id'=>$memberId,
        	                'book_id'=>$bookModel->book_id,
        	                'access'=>$access
        	            );
        	            $obModel->attributes = $data;
        	            $obModel->save();
        	        }
        	        
        	        //增加一条course_book关系的同时，也增加一条cb_up_down的记录
        	        $data = array(
        	            'member_id'=>$memberId,
        	            'cb_id'=>$courseBookModel->c_b_id,
        	            'updown'=>'up'
        	        );
        	        
        	        $cbudModel = new CbUpDown();
        	        $cbudModel->attributes = $data;
        	        if($cbudModel->save()){
    	                $this->redirect ( array ('viewbook', 'bid' => $bookModel->book_id ) );
        	        }else{
        	            
        	        }
        	    }
    	    }
        	$this->render('addbook');
	    }
	}
	
	public function actionDeletebook()
	{
		$this->render('deletebook');
	}

	public function actionEditbook()
	{
		$this->render('editbook');
	}

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionViewbook()
	{
	    $bookId = $_REQUEST['bid'];
	    
        $row = Books::model()
	    ->with(array(
    	        'providerdetail'=> array(
    	        )
	       )
        )
        ->with(array(
                'courseBooks'=>array(
                )
            )
        )
	    ->findByPk($bookId);
	    
	    //整理数据库中取出的数据
	    $book['book_id'] = $row->book_id;
	    $book['book_name'] = $row->book_name;
	    $book['comment'] = $row->comment;
	    
	    $book['provider_id'] = $row->providerdetail->user_id;
	    $book['provider_name'] = $row->providerdetail->username;
	    
	    /**
	     * @author Javoft
	     * TODO 这里可以首先取出一部分书籍编辑者的信息显示，以鼓励大家共同编辑书籍
	     * @version 1.0 首先之显示出拥有这本书的人
	     * 需要取出有这本书的人
	     */
	    $rows = Books::model()
	    ->with('bookowner')
	    ->with('bookowner.owner')
	    ->findAll('bookowner.book_id = :book_id', array(':book_id'=>$bookId));
	    
	    //整理拥有此本书的用户的数据
	    $ownerList = array();
	    foreach ($rows as $row){
	        foreach ($row->bookowner as $o){
	            $owner = array();
	            $owner['owner_name'] = $o->owner->username;
	            $owner['owner_id'] = $o->owner->user_id;
	            $owner['avatar_path'] = $o->owner->avatar_path;
	            $ownerList[] = $owner;
	        }
	    }
	    //取出和这本书籍相关的课程
	    $rows  = Books::model()
	    ->with(
	        'courseBooks'
	    )
	    ->with('courseBooks.course')
	    ->findAll('courseBooks.book_id = :book_id', array(':book_id'=>$bookId));
	    
	    //整理和书籍相关课程的数据
	    $relCourseList = array();
	    foreach ($rows as $row){
            foreach ($row->courseBooks as $r){
	           $relCourse  = array();
    	        $relCourse['course_id'] = $r->course->course_id;
    	        
    	        $relCourse['course_name'] = $r->course->course_name;
    	        $relCourseList[] = $relCourse;
            }
	    }
	    
	    //取出其他用户对此书的评论
	    $row = Books::model()
	    ->with('bookComment')
	    ->with('bookComment.user')
	    ->with('bookComment.user.major')
	    ->findByPk($bookId);
	    //整理取出的书籍评论
        $commentList = array();
        if($row->bookComment){
    	    foreach ($row->bookComment as $c){
    	        $comment = array();
    	        $comment['content'] = $c->content;
    	        $comment['username'] = $c->user->username;
    	        $comment['user_id'] = $c->user->user_id;
    	        $comment['avatar_path'] = $c->user->avatar_path;
    	        $comment['add_time'] = $c->add_time;
    	        $comment['major'] = $c->user->major->major_name;
    	        $comment['star'] = $c->star;
    	        
    	        $commentList[] = $comment;
    	    }
        }
        
        //取出学院列表$deps
        $rows = Departments::model()
        ->findAll(array('select'=>'dep_id, dep_name'));
        
        //整理数据
        foreach ($rows as $row){
            $dep = array();
            $dep['dep_id'] = $row->dep_id;
            $dep['dep_name'] = $row->dep_name;
            
            $deps[] = $dep;
        }
		$this->render(
		'viewbook',
		array(
			'book'=>$book, 
			'relCourse'=>$relCourseList, 
			'ownerList'=>$ownerList, 
			'bookComments'=>$commentList,
		    'deps' => $deps,
		)
		);
	}
	
	//为书籍添加相关课程
	public function actionAddrelcourse(){
	    $memberId = Yii::app()->user->getState('user_id');
	    $bookid = $_REQUEST['bookid'];
	    $courseId = $_REQUEST['courseid'];
	    
	    $cbModel = new CourseBook();
	    $data = array(
	        'book_id' => $bookid,
	        'course_id' => $courseId
	    );
	    $row = $cbModel->findByAttributes($data);
	    if($row){
	        //如果关系已经存在,则在cb_up_down中up一下
	        $cbId = $row->c_b_id;
	        
	        $data = array(
	            'member_id' => $memberId,
	            'cb_id' => $cbId
	        );
	        $row = CbUpDown::model()
	        ->findByAttributes($data);
	        if($row){
	            //在cb_up_down也已经有记录，已经推荐过
	        }else{
	            //在cb_up_down 中也没有记录，default的up一下
	            $cbudModel = new CbUpDown();
	            $cbudModel->attributes = $data;
	            $cbudModel->save();
	        }
	    }else{
	        //还没有人建立过此书和此课程的关系
	        $cbModel->attributes = $data;
	        $cbModel->save();
	    }
	}
	
	/**
	 * 在为书籍添加其他课程的时候，辅助
	 */
	public function actionAddRelHelper(){
	    $act = $_REQUEST['act'];
	    
	    switch($act){
	        case 'deps':
	            break;
            case 'getmajor':
                $depId = $_REQUEST['depid'];
                $rows = Major::model()
                ->findAll(array('select'=>'major_name, major_id', 'condition'=>"dep_id = '$depId'"));
                
                //整理数据
                $majors = array();
                foreach ($rows as $row){
                    $major = array();
                    $major['major_name'] = $row->major_name;
                    $major['major_id'] = $row->major_id;

                    $majors[] = $major;
                }
                echo json_encode($majors);
	            break;
            case 'getcourse':
                $majorid = $_REQUEST['majorid'];
                $rows = Actualclass::model()
                ->findAll(array(
                    'select'=>'course_id',
                    'condition'=>"major_id = $majorid",
                ));
                
                $courseids = array();
                foreach($rows as $row){
                    $courseids[] = $row->course_id;
                }
                
                $data = array(
                    'course_id' => $courseids
                );
                $rows = Course::model()
                ->findAllByAttributes($data);
                
                //整理数据
                $courseList = array();
                foreach ($rows as $row){
                    $course = array();
                    $course['course_id'] = $row->course_id;
                    $course['course_name'] = $row->course_name;
                    
                    $courseList[] = $course;
                }
                
                echo json_encode($courseList);
//                $rows = Course::model()
//                ->with(array(
//                    'actualclasses',
//                        array(
//                            'select'=>'',
//                            'condition'=>''
//                        )
//                    )
//                )
//                ->findAll();
	    }
	}
	
	public function actionAddcomment(){
	    $memberId = Yii::app()->user->getState('user_id');
	    $content  = $_REQUEST['content'];
	    $bookId = $_REQUEST['bookid'];
	    if($content && $bookId){
	        $bcModel = new Bookcomment();
	        $data = array(
	            'book_id'=>$bookId,
	            'user_id'=>$memberId,
	            'content'=>$content
	        );
	        $bcModel->attributes = $data;
	        if($bcModel->save()){
	            //成功
	            $bcId = $bcModel->bookcomment_id;
	            $row = Bookcomment::model()
        	    ->with('user')
        	    ->with('user.major')
        	    ->findByPk($bcId);
        	    
        	    
                $comment = array();
    	        $comment['content'] = $row->content;
    	        $comment['username'] = $row->user->username;
    	        $comment['user_id'] = $row->user->user_id;
    	        $comment['avatar_path'] = $row->user->avatar_path;
    	        $comment['add_time'] = $row->add_time;
    	        $comment['major'] = $row->user->major->major_name;
    	        $comment['star'] = $row->star;
    	        
	            echo json_encode($comment);
	        }else{
	            //添加失败
	        }
	    }else{
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