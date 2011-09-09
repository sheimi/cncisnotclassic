<?php
/**
 * 
 * 此Controller主要负责课程搜索相关的工作，再搜索课程对的过程中可能
 * 需要对书籍或者users的数据进行一定的搜索
 * @author Javoft
 *
 */
class SearchController extends Controller
{
    private $pageCapacity = 20;
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
	public function actionIndex()
	{
		$this->render ( 'index' );
	}
	
	public function actionAll($q){
	    if('' != $q){
	        if (isset($_GET['page']) && is_numeric($_GET['page'])){
	            $page = $_GET['page'];
	        }else{
	            $page = 1;
	        }
    	    //课程搜索
    	    $memberId = Yii::app()->user->getState('user_id');
    		//分Course查询开设本门课程的院系和上课教师
    		$rows = Course::model()
    		->with('actualclasses.major')
    		->with('actualclasses.teachers')
    		->findAll('course_name like :q', array(':q'=>"%$q%"));
    		
    		//整理数据
    		$courseList = array();
    		foreach ($rows as $row){
    		    $course = array();
    		    $course['course_id'] = $row->course_id;
    		    $course['course_name'] = $row->course_name;
    		    
    		    $data = array(
    		        'member_id' => $memberId,
    		        'course_id' => $row->course_id
    		    );
    		    $likeCourse = LikeCourse::model()->findByAttributes($data);
    		    
    		    if($likeCourse){
    		         $course['star'] = $likeCourse->star;
    		    }
    		    foreach ($row->actualclasses as $actualclass) {
    		        $course['major'][] = $actualclass->major;
    		        foreach($actualclass->teachers as $t){
    			        $course['teachers'][$actualclass->major->major_id][] = $t;
    		        }
    		    }
    		    $courseList[] = $course;
    		}
    		$favCourseList = $this->getFavCourse(20);
    	    $this->render('all', array(
    	        'courseList'=>$courseList,
    	        'currenttab'=>'course',
    	    	'favCourseList' => $favCourseList,
    	        'q'=>$q
    	    ));
	    }else{
	        $this->redirect(BU . 'cs');
	    }
	}
	
	public function actionQuery(){
	    if(isset($_GET['q']) && isset($_GET['type'])){
	        $q = $_GET['q'];
	        $memberId = Yii::app()->user->getState('user_id');
	        $type = $_GET['type'];
	        switch ($type){
	            case 'course':
	                //分Course查询开设本门课程的院系和上课教师
            		$rows = Course::model()
            		->with('actualclasses.major')
            		->with('actualclasses.teachers')
            		->findAll('course_name like :q', array(':q'=>"%$q%"));
            		
            		//整理数据
            		$courseList = array();
            		foreach ($rows as $row){
            		    $course = array();
            		    $course['course_id'] = $row->course_id;
            		    $course['course_name'] = $row->course_name;
            		    
            		    $data = array(
            		        'member_id' => $memberId,
            		        'course_id' => $row->course_id
            		    );
            		    $likeCourse = LikeCourse::model()->findByAttributes($data);
            		    
            		    if($likeCourse){
            		         $course['star'] = $likeCourse->star;
            		    }
            		    foreach ($row->actualclasses as $actualclass) {
            		        $course['major'][] = $actualclass->major;
            		        
            		        foreach($actualclass->teachers as $t){
            			        $course['teachers'][$actualclass->major->major_id][] = $t;
            		        }
            		    }
            		    $courseList[] = $course;
            		}
            		$favCourseList = $this->getFavCourse(20);
            	    $this->renderPartial('course', array(
            	        'courseList'=>$courseList,
            	        'currenttab'=>'course',
            	    	'favCourseList' => $favCourseList,
            	        'q'=>$q
            	    ));
            	    
	                break;
	            case 'teacher':
	                $teachers = Teacher::model()
        			->findAll('teacher_name like :q', array(':q'=>"%$q%"));
        			
        			$results = array ();
        			foreach ( $teachers as $teacher )
        			{
        			    $teacher_info = array();
        			    $teacher_info["t_name"] = $teacher->teacher_name;
        			    $teacher_info["t_id"] = $teacher->teacher_id;
        			    
        			    //获取Course的ID组
        				$courses_id = array ();
        				$classes = $teacher->actualclasses;
        				foreach ($classes as $class) {
        				    $courses_id [] = $class->course_id;
        				}
        				$courses_id = array_unique ( $courses_id );
        				
        				//分别获取Course的详细信息
        				$courses = array ();
        				foreach ( $courses_id as $course_id )
        				{
        					$courses [] = Course::model ()->findByPk ( $course_id );
        				}
        				
        				$teacher_info["courses"] = $courses;
        				$results[] = $teacher_info;
        			}
        			
        			$this->renderPartial('teacher', array('teacherList'=>$results, 'q'=>$q));
	                break;
                case 'classroom':
	                break;
	            case 'book':
	                $rows = Books::model ()
            		->findAll('book_name like :bm', array(':bm'=>"%$q%"));
            		
            		//整理数据
            		$bookList = array();
            		foreach ($rows as $row){
            		    $book = array();
            		    $book['book_name'] = $row->book_name;
            		    $book['book_id'] = $row->book_id;
            		    $book['author'] = $row->author;
            		    $book['publisher'] = $row->publisher;
            		    $book['comment'] = $row->comment;
            		    
            		    //获取相关课程的数据
            		    $bookId = $book['book_id'];
            		    $rows = CourseBook::model()
            		    ->with(array(
            		        'course'=>array(
            		            'select'=>'course_name, course_id'
                		        )
                		    )
            		    )
            		    ->findAll('book_id = :bid', array(':bid'=>$bookId));
            		    
            		    //整理数据
            		    $relCourseList = array();
            		    foreach ($rows as $row){
            		        $relCourse = array();
            		        $relCourse['course_name'] = $row->course->course_name;
            		        $relCourse['course_id'] = $row->course->course_id;
            		        $relCourseList[] = $relCourse;
            		    }
            		    $book['relcourse'] = $relCourseList;
            		    
            		    //获取有该书的njuer的id和name
            		    $rows = OwnerBook::model()
            		    ->with('owner')
            		    ->findAll(array(
                		    	'condition'=>"book_id = $bookId",
            		            'order'=>'mark_time desc',
                		        'limit'=>20,
                		    )
                		);
            		    //整理数据
            		    $ownerList = array();
            		    foreach ($rows as $row){
            		        $owner = array();
            		        $owner['username'] = $row->owner->username;
            		        $owner['userid'] = $row->owner->user_id;
            		        $owner['access'] = $row->access;
            		        
            		        $ownerList[] = $owner;
            		    }
            		    $book['ownerList'] = $ownerList;
            		    
            		    $bookList[] = $book;
            		}
            		
            		
            		//获取推荐书籍最多的用户
            		$itemNum = 10;
            		$activeUserOnAddBook = $this->getActiveUserOnAddBook($itemNum);
            		
            		$mostViewdBookNum = 20;
            		$mostViewdBook = $this->getMostViewdBook($mostViewdBookNum);
            		$this->renderPartial(
            			'book', 
            		    array(
            		    	'bookList'=>$bookList,
            		        'activeUserList'=>$activeUserOnAddBook,
            		        'mostViewdBook'=>$mostViewdBook,
            		    	'q'=>$q,
            		    )
            	    );
	                break;
	        }
	        Yii::app()->end();
	    }
	}
	/**
	 * to find books by course provided
	 * return json
	 */
	public function actionSBooksbCourse()
	{
		$searchCourse = trim($_REQUEST ["course"]);
		if(!$searchCourse){
		    $this->redirect(Yii::app()->request->baseUrl);
		}else{
    		$sql = "select * from course where course_name like '%$searchCourse%'";
    		$courses = Course::model ()->findAllBySql ( $sql );
    		$result = array ();
    		foreach ( $courses as $course )
    		{
    			$r = array ();
    			$books = $course->courseBooks;
    			foreach ( $books as $book )
    			{
    				$b = array ();
    				$b ["book_name"] = $book->book->book_name;
    				$b ["isbn"] = $book->book->isbn;
    				$b ["provider"] = $book->book->provider0->username;
    				$r [] = $b;
    			}
    			$result [] = $r;
    		}
    		echo json_encode ( $result );
    		Yii::app ()->end ();
		}
	}
	
	/**
	 * to find the complete course name that may match the input provided
	 * return json  array of course name 
	 */
	public function actionSCourse()
	{
	    $memberId = Yii::app()->user->getState('user_id');
		$searchCourse = trim($_REQUEST ["course"]);
		if(!$searchCourse){
		    $this->redirect(Yii::app()->request->baseUrl);
		}else{
    		//分Course查询开设本门课程的院系和上课教师
			$rows = Course::model()
			->with('actualclasses.major')
			->with('actualclasses.teachers')
			->findAll('course_name like :q', array(':q'=>"%$searchCourse%"));
			
			
			//整理数据
			$courseList = array();
			foreach ($rows as $row){
			    $course = array();
			    $course['course_id'] = $row->course_id;
			    $course['course_name'] = $row->course_name;
			    
			    $data = array(
			        'member_id' => $memberId,
			        'course_id' => $row->course_id
			    );
			    $likeCourse = LikeCourse::model()->findByAttributes($data);
			    
			    if($likeCourse){
			         $course['star'] = $likeCourse->star;
			    }
			    foreach ($row->actualclasses as $actualclass) {
			        $course['major'][] = $actualclass->major;
			        
			        foreach($actualclass->teachers as $t){
    			        $course['teachers'][$actualclass->major->major_id][] = $t;
			        }
			    }
			    
			    $courseList[] = $course;
			}
		}
		
		//获取被标记为喜爱次数最多的课程
		$favCourseList = $this->getFavCourse(20);

		$this->render(
			'scourse', 
		    array(
		    	'q'=>$searchCourse,
		        'courseList' => $courseList,
		        'favCourseList' => $favCourseList,
		    )
	    );
	}
	
	/**
	 * to find the coursename of a teacher
	 * return json  array of teachers and coursenames
	 */
	public function actionSCourseBTeacher()
	{
		$searchCourse = trim($_REQUEST ["teacher"]);
		if(!$searchCourse){
		    $this->redirect(Yii::app()->request->baseUrl);
		}else{    
			$teachers = Teacher::model()
			->findAll('teacher_name like :q', array(':q'=>"%$searchCourse%"));
			
			$results = array ();
			foreach ( $teachers as $teacher )
			{
			    $teacher_info = array();
			    $teacher_info["t_name"] = $teacher->teacher_name;
			    $teacher_info["t_id"] = $teacher->teacher_id;
			    
			    //获取Course的ID组
				$courses_id = array ();
				$classes = $teacher->actualclasses;
				foreach ($classes as $class) {
				    $courses_id [] = $class->course_id;
				}
				$courses_id = array_unique ( $courses_id );
				
				//分别获取Course的详细信息
				$courses = array ();
				foreach ( $courses_id as $course_id )
				{
					$courses [] = Course::model ()->findByPk ( $course_id );
				}
				
				$teacher_info["courses"] = $courses;
				$results[] = $teacher_info;
			}
			
			$this->render('SCourseBTeacher', array('teacherList'=>$results, 'q'=>$searchCourse));
		}
	}
	
	public function actionSBook(){
	    $bookName = trim($_REQUEST ["book"]);
		if(!$bookName){
		    $this->redirect(Yii::app()->request->baseUrl);
		}else{
    		$rows = Books::model ()
    		->findAll('book_name like :bm', array(':bm'=>"%$bookName%"));
    		
    		//整理数据
    		$bookList = array();
    		foreach ($rows as $row){
    		    $book = array();
    		    $book['book_name'] = $row->book_name;
    		    $book['book_id'] = $row->book_id;
    		    $book['author'] = $row->author;
    		    $book['publisher'] = $row->publisher;
    		    $book['comment'] = $row->comment;
    		    
    		    //获取相关课程的数据
    		    $bookId = $book['book_id'];
    		    $rows = CourseBook::model()
    		    ->with(array(
    		        'course'=>array(
    		            'select'=>'course_name, course_id'
        		        )
        		    )
    		    )
    		    ->findAll('book_id = :bid', array(':bid'=>$bookId));
    		    
    		    //整理数据
    		    $relCourseList = array();
    		    foreach ($rows as $row){
    		        $relCourse = array();
    		        $relCourse['course_name'] = $row->course->course_name;
    		        $relCourse['course_id'] = $row->course->course_id;
    		        $relCourseList[] = $relCourse;
    		    }
    		    $book['relcourse'] = $relCourseList;
    		    
    		    //获取有该书的njuer的id和name
    		    $rows = OwnerBook::model()
    		    ->with('owner')
    		    ->findAll(array(
        		    	'condition'=>"book_id = $bookId",
    		            'order'=>'mark_time desc',
        		        'limit'=>20,
        		    )
        		);
    		    //整理数据
    		    $ownerList = array();
    		    foreach ($rows as $row){
    		        $owner = array();
    		        $owner['username'] = $row->owner->username;
    		        $owner['userid'] = $row->owner->user_id;
    		        $owner['access'] = $row->access;
    		        
    		        $ownerList[] = $owner;
    		    }
    		    $book['ownerList'] = $ownerList;
    		    
    		    $bookList[] = $book;
    		}
    		
    		
    		//获取推荐书籍最多的用户
    		$itemNum = 10;
    		$activeUserOnAddBook = $this->getActiveUserOnAddBook($itemNum);
    		
    		$mostViewdBookNum = 20;
    		$mostViewdBook = $this->getMostViewdBook($mostViewdBookNum);
    		$this->render(
    			'sbook', 
    		    array(
    		    	'bookList'=>$bookList,
    		        'activeUserList'=>$activeUserOnAddBook,
    		        'mostViewdBook'=>$mostViewdBook,
    		    	'q'=>$bookName,
    		    )
    	    );
    		
	    }
	}
	
	/**
	 * @author Javoft
	 * 获取关注度最高的课程
	 * @param $num 获取的条数
	 */
	public function getFavCourse($num){
	    
	    $db = Yii::app()->db;
	    // TODO 这里先用不太优雅的方式实现
	    $sql = "SELECT c.course_name AS course_name, c.course_id AS course_id, COUNT(member_id) AS total FROM like_course lc JOIN course c ON lc.course_id = c.course_id WHERE lc.star >= 4 GROUP BY course_id ORDER BY total DESC  LIMIT 0, $num";
	    $cmd = $db->createCommand($sql);
	    $rows = $cmd->queryAll();
	    
	    //整理数据
	    $favCourseList = array();
	    foreach ($rows as $row){
	        $favCourse = array();
	        $favCourse['course_name'] = $row['course_name'];
	        $favCourse['course_id'] = $row['course_id'];
	        $favCourse['course_fans'] = $row['total'];
	        $favCourseList[] = $favCourse;
	    }
	    return $favCourseList;
	}
	
	/**
	 * @author Javoft
	 * @param unknown_type $num
	 */
	private function getActiveUserOnAddBook($num){
	    $db = Yii::app()->db;
	    // TODO 这里先用不太优雅的方式实现
	    $sql = "SELECT provider, COUNT(*) book_total, users.username username, users.user_id user_id FROM books JOIN `users` ON `users`.user_id = provider GROUP BY provider ORDER BY book_total DESC LIMIT $num";
	    $cmd = $db->createCommand($sql);
	    $rows = $cmd->queryAll();
	    
	    //整理数据
	    $activeUserList = array();
	    foreach ($rows as $row){
	        $activeUser = array();
	        $activeUser['username'] = $row['username'];
	        $activeUser['user_id'] = $row['user_id'];
	        $activeUserList[] = $activeUser;
	    }
	    
	    return $activeUserList;
	}
	
	private function getMostViewdBook($num){
	    $sql = "SELECT COUNT(bv_history_id) bvh_total, books.`book_name` book_name, books.`book_id` book_id ";
	    $sql .= "FROM bv_history ";
	    $sql .= "JOIN books  ON books.`book_id` = bv_history.`book_id` ";
	    $sql .= "GROUP BY book_id "; 
	    $sql .= "ORDER BY bvh_total DESC ";
	    $sql .= "LIMIT $num";
	    
	    $db = Yii::app()->db;
	    $cmd = $db->createCommand($sql);
	    $rows = $cmd->queryAll();
	    
	    //整理数据
	    $mostViewedBookList = array();
	    foreach ($rows as $row){
	        $mostViewedBook = array();
	        $mostViewedBook['book_name'] = $row['book_name'];
	        $mostViewedBook['book_id'] = $row['book_id'];
	        $mostViewedBook['total'] = $row['bvh_total'];
	        $mostViewedBookList[] = $mostViewedBook;
	    }
	    return $mostViewedBookList;
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
	*/
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