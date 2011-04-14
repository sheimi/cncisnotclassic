<?php

class CourseController extends Controller
{
	public function actionView()
	{
	    $courseId = $_REQUEST['cid'];
	    
	    //查处课程信息
	    $row = Course::model()->findByPk($courseId);
	    $courseDetail['course_id'] = $row->course_id;
	    $courseDetail['course_name'] = $row->course_name;
	    
	    //根据课程，获得课程的课节信息（ActualClass）
//	    $criteria = new CDbCriteria();
//	    $criteria->select = array();
//	    $criteria->condition = '';

	    //需要选择出 院系信息
	    $rows = ActualClass::model()->with(
	        //一门课可能有多个老师
    	    array(
    	    	'teachers'=>array('select'=>'teacher_id, teacher_name'),
    	    )
	    )
	    ->with(
	        //一门Actualclass 只可能是一个院系的
	        array(
    	    	'major'=>array(
    	    		'select'=>'major_id, major_name',
	            )
	        )
	    )
	    ->findAll("course_id = :course_id", array(':course_id'=>$courseId));
	    
//	    var_dump($rows);
	    $actualClassList = array();
	    
	    foreach ($rows as $row){
	        $actualClass = array();
	        $actualClass['major'] = array(
	            'major_id' => $row->major->major_id,
	            'major_name' => $row->major->major_name
	        );
	        
	        //上课的年级
	        $actualClass['grade'] = $row->grade;
	        
	        //该院系这门课的教师信息
            $actualClass['teachers'] = $row->teachers;
            
            //上课的时间和地点
            $actualClass['site'] = $row->site;
            
            //该门课程在该院系的类型（核心or选修）
            $actualClass['course_type'] = $row->course_type;
            
            //这门课在这个院系的学分数
            $actualClass['credit'] = $row->credit;
            
            $actualClassList[] = $actualClass;
	    }
	    
	    
	    //下面获取推荐的书籍
        $rows = Books::model()
	    ->with(array(
	            'providerdetail'=>array(
	                'select'=>'bbs_name'
	            )
	        )
	    )
	    ->with(array(
	            'courseBooks'=>array(
	                'condition'=>"course_id = $courseId",
	                array('course_id'=>$courseId)
	            )
	        )
	    )
	    ->findAll();
	    
	    
	    //整理数据库中取出的数据
	    $booksList = array();
	    foreach ($rows as $row){
	        $book = array();
	        $book['book_id'] = $row->book_id;
	        $book['book_name'] = $row->book_name;
	        $book['isbn'] = $row->isbn;
	        $book['provider_name'] = $row->providerdetail->bbs_name;
	        $booksList[] = $book;
	    }
	    var_dump($booksList);
	    
		$this->render('view', array(
		'actualClassList' => $actualClassList,
		'booksList'=>$booksList,
		'courseId'=>$courseId
		)
		);
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