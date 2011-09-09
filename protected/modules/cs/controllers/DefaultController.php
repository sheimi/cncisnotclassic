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
	    ->findAll(array('limit'=>180, 'order'=>'book.book_id desc', 'distinct'=>'cb.book.book_id'));
	    
	    //整理数据
	    $i = 0;
	    $cbList = array();
	    function dup($cbList, $book_id){
	        foreach ($cbList as $cb)
	        {
	            if($cb['book']['book_id'] == $book_id){
	                return true;
	            }
	        }
	        return false;
	    }
	    foreach ($rows as $row){
	        $book_id = $row->cb->book->book_id;
	        if(!dup($cbList, $book_id)){
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
    	        if($i++ >=17){
    	            break;
    	        }
	        }
	    }
	    
	    $favCourseList = $this->getFavCourse(15);
		$this->render (
			'index',
		    array(
		        'hotbookList'=>$cbList,
		        'favCourseList'=>$favCourseList,
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