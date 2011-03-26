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
		$this->render('index');
	}

    /**
     * to find books by course provided
     * return json
     */
    public function actionSbooksbcourse()
    {
        $search_course = $_GET["course"];
        $sql = "select * from course where course_name = '$search_course'";
        $courses = Course::model()->findAllBySql($sql);
        $result = array();
        foreach ($courses as $course) {
            $r = array();
            $books = $course->courseBooks;
            foreach ($books as $book) {
                $b = array();
                $b["book_name"] = $book->book->book_name;
                $b["isbn"] = $book->book->isbn;
                $b["provider"] = $book->book->provider0->username;
                $r[] = $b;
            }
            $result[] = $r;
        }
        echo json_encode($result);
        Yii::app()->end();
    }
    
    /**
     * to find the complete course name that may match the input provided
     * return json  array of course name 
     */
    public function actionSearchcourse()
    {
        $search_course = $_POST["course"];
        if (isset($search_course)) {
            $sql = "select * from course where course_name like '%$search_course%'";
            $courses = Course::model()->findAllBySql($sql);
            $result = array();
            foreach ($courses as $course) {
                $result[] = $course->course_name;
            }
            echo json_encode($result);
        }
        Yii::app()->end();
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