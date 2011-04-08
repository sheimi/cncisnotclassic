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
		$searchCourse = $_GET ["course"];
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
		$searchCourse = $_POST ["course"];
		if (isset ( $searchCourse ))
		{
			$sql = "select * from course where course_name like '%$searchCourse%'";
			$courses = Course::model ()->findAllBySql ( $sql );
			$result = array ();
			foreach ( $courses as $course )
			{
				$result [] = $course->course_name;
			}
			echo json_encode ( $result );
		}
		Yii::app ()->end ();
	}
	
	/**
	 * to find the coursename of a teacher
	 * return json  array of teachers and coursenames
	 */
	public function actionSCourseBTeacher()
	{
		$searchCourse = $_POST ["teacher"];
		if (isset ( $searchCourse ))
		{
			$sql = "select * from teacher where teacher_name like '%$searchCourse%'";
			$teachers = Teacher::model ()->findAllBySql ( $sql );
			$results = array ();
			
			foreach ( $teachers as $teacher )
			{
			    $teacher_info = array();
			    $teacher_info["t_name"] = $teacher->teacher_name;
			    
				$courses_id = array ();
				$classes = $teacher->actualclasses;
				foreach ($classes as $class) {
				    $courses_id [] = $class->course_id;
				}
				array_unique ( $courses_id );
				$courses = array ();
				foreach ( $courses_id as $course_id )
				{
					$courses [] = Course::model ()->find ( "course_id", $course_id );
				}
				$m = array ();
				foreach ( $courses as $course )
				{
					$m[] = $course->course_name;
				}
				$teacher_info["courses"] = $m;
				$results[] = $teacher_info;
			}	
			echo json_encode ( $results );
		}
		Yii::app ()->end ();
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