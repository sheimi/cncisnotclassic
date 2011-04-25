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
	public function actionIndex()
	{
		$this->render ( 'index' );
	}
	
	/**
	 * to find books by course provided
	 * return json
	 */
	public function actionSBooksbCourse()
	{
		$searchCourse = trim($_REQUEST ["course"]);
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
	
	/**
	 * to find the complete course name that may match the input provided
	 * return json  array of course name 
	 */
	public function actionSCourse()
	{
		$searchCourse = trim($_REQUEST ["course"]);
		if (isset ( $searchCourse ))
		{
    		//分Course查询开设本门课程的院系和上课教师
			$sql = "select * from course where course_name like '%$searchCourse%'";
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
			    
			    foreach ($row->actualclasses as $actualclass) {
			        $course['major'][] = $actualclass->major;
			        
			        foreach($actualclass->teachers as $t){
    			        $course['teachers'][$actualclass->major->major_id][] = $t;
			        }
			    }
			    
			    $courseList[] = $course;
			}
		}
		
		$this->render('scourse', array('q'=>$searchCourse, 'courseList' => $courseList));
	}
	
	/**
	 * to find the coursename of a teacher
	 * return json  array of teachers and coursenames
	 */
	public function actionSCourseBTeacher()
	{
		$searchCourse = trim($_REQUEST ["teacher"]);
		if (isset ( $searchCourse ))
		{
			$sql = "select * from teacher where teacher_name like '%$searchCourse%'";
			$teachers = Teacher::model ()->findAllBySql ( $sql );
			
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
			
			$this->render('SCourseBTeacher', array('teacherList'=>$results));
		}else{
		    $this->redirect('index.php?r=cs');
		}
	}
	
	public function actionSBook(){
	    $bookName = trim($_REQUEST ["book"]);
	    if($bookName){
    		$sql = "select * from books where book_name like '%$bookName%'";
    		$books = Books::model ()->findAllBySql ( $sql );
    		
    		$this->render('sbook', array('bookList'=>$books, 'q'=>$bookName));
	    }else{
	        $this->redirect('index.php?r=cs');
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