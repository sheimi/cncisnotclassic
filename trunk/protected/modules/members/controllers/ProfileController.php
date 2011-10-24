<?php

class ProfileController extends Controller
{
    
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
	    $memberId = Yii::app()->user->getState('user_id');
	    
	    //获取他推荐的书籍
	    $rows = Books::model()
	    ->findAll("provider = $memberId limit 12");
	    //整理书籍数据
	    $bookList = array();
	    foreach ($rows as $row){
	        $book = array();
	        $book['book_name'] = $row->book_name;
	        $book['image'] = $row->cover_path;
	        $book['book_id'] = $row->book_id;
	        $book['add_time'] = $row->add_time;
	        $bookList[] = $book;
	    }
	    
	    //获取他标记为 有 的书
	    $rows = OwnerBook::model()
	    ->with('book')
	    ->findAll('owner_id = :oid', array(':oid'=>$memberId));
	    $ownBooks = array();
	    foreach ($rows as $row)
	    {
	        $ownBook = array();
	        $ownBook['book_name']=$row->book->book_name;
	        $ownBook['book_id']=$row->book->book_id;
	        $ownBook['isbn']=$row->book->isbn;
	        $ownBook['provider']=$row->book->provider;
	        $ownBook['cover_path'] = $ownBook['image'] =$row->book->cover_path;
	        $ownBook['add_time']=$row->book->add_time;
	        $ownBook['publisher']=$row->book->publisher;
	        $ownBook['pudate']=$row->book->pubdate;
	        $ownBook['price']=$row->book->price;
	        $ownBooks[] = $ownBook;
	    }
	    
	     //获取他为课程推荐的书籍
	    $updownBookList = $this->getUpdownCourse($memberId, 12);
	    
	    //获取他关注的课程
	    
	    
	    //获取他的课程表
	    $userId = Yii::app()->user->getState('user_id');
	    
//	    $myClassList = $this->getMyClass($userId);
	    
	    //获取用户喜欢的课程
//	    $likeCourseList = $this->getLikeCourse($memberId);
	    
	    //获得当前用户资料
	    $currentUserInfo = $this->getUserInfo($memberId);
	    
	    //获取用户的隐私设置
//	    $row = KeepPrivate::model()->findByPk($memberId);
//	    $keepPrivate['user_id'] = $row->user_id;
//	    $keepPrivate['email'] = $row->bbs_name;
//	    $keepPrivate['myclass'] = $row->myclass;
	    
	    $return = array(
	        'recommendBookList' => $bookList,
	        'ownBookList' => $ownBooks,
	        'updownBookList' => $updownBookList,
//	        'favCourseList' => $likeCourseList,
//	        'myclass'=>$myClassList,
	        'userInfo'=>$currentUserInfo,
//	        'keepPrivate'=>$keepPrivate,
	        //'errorMsg'=>$errorMsg,
	    );
	    $this->render('index', $return);
	}
	
	/**
	 * @author Javoft
	 * 这里展示他有的书籍
	 * 他推荐的书籍AND课程
	 * 他关注的课程
	 * 他的课程表
	 */
	public function actionView($uid){
	    
	    if(!is_numeric($uid)){
	        $this->redirect(Yii::app()->request->baseUrl);
	    }
	    //获取用户隐私设置
	    $row = KeepPrivate::model()
	    ->findByPk($uid);
	    
	    if($row->myclass == 'public'){
	        $myClassList = $this->getMyClass($uid);
	    }
	    
	    $userInfo = $this->getUserInfo($uid);
	    
	    //获取他添加的书
	    $rows = Books::model()
	    ->findAll("provider = :uid", array(':uid'=>$uid));
	    
	    //整理书籍数据
	    $bookList = array();
	    foreach ($rows as $row){
	        $book = array();
	        $book['book_name'] = $row->book_name;
	        $book['cover_path'] = $row->cover_path;
	        $book['book_id'] = $row->book_id;
	        $book['add_time'] = $row->add_time;
	        $book['image'] = $row->cover_path;
	        $bookList[] = $book;
	    }
	    
	    //获取他标记为 有 的书
	    $rows = OwnerBook::model()
	    ->with('book')
	    ->findAll('owner_id = :oid', array(':oid'=>$uid));
	    $ownBooks = array();
	    foreach ($rows as $row)
	    {
	        $ownBook = array();
	        $ownBook['book_name']=$row->book->book_name;
	        $ownBook['isbn']=$row->book->isbn;
	        $ownBook['provider']=$row->book->provider;
	        $ownBook['cover_path'] = $ownBook['image'] =$row->book->cover_path;
	        $ownBook['add_time']=$row->book->add_time;
	        $ownBook['publisher']=$row->book->publisher;
	        $ownBook['pudate']=$row->book->pubdate;
	        $ownBook['price']=$row->book->price;
	        $ownBooks[] = $ownBook;
	    }
	    
	    
	    //获取他updown的书籍
	    $updownCourseList = $this->getUpdownCourse($uid);
	    
	    //获取他喜欢的课程
	    $likeCourseList = $this->getLikeCourse($uid);
	    
	    $classes = $this->getMyClass(Yii::app()->user->getState('user_id'));
	    
	    $return = array(
	        'recommendBookList' => $bookList,
	        'updownBookList' => $updownCourseList,
	        'ownBookList' => $ownBooks,
	        'likeCourseList' => $likeCourseList,
	        'userInfo' => $userInfo,
	        'myclass'=>$classes,//当前用户的课程表
	    );
	    //获取他的课程表
	    $this->render('view', $return);
	}
	
	public function actionRecommendbooks()
	{
	    $memberId = Yii::app()->user->getState('user_id');
	    //获取他添加的书籍
	    $rows = Books::model()
	    ->findAll("provider = $memberId");
	    
	    //整理书籍数据
	    $bookList = array();
	    foreach ($rows as $row){
	        $book = array();
	        $book['book_name'] = $row->book_name;
	        $book['image'] = $row->cover_path;
	        $book['book_id'] = $row->book_name;
	        $book['add_time'] = $row->add_time;
	        $bookList[] = $book;
	    }
	    $this->render('recommendbooks', array('recommendBookList'=>$bookList));
	}
	
    public function actionChangepswform(){
        $this->renderPartial('changepswform');
    }
    
    public function actionSavenewpsw(){
        $oldpsw = $_POST['oldpsw'];
        $newpsw = $_POST['newpsw'];
        $newconfirm = $_POST['newconfirm'];
        
        if( $newpsw != $newconfirm ){
            echo '两次输入的新密码不匹配';
            Yii::app()->end();
        }
        
        
        $username = Yii::app()->user->getState('username');
        $rows = Users::model()
        ->findAll('username=:username AND password=:password', 
        array(':username'=>$username, ':password'=>md5($oldpsw)));
        if(sizeof($rows) == 0){
           echo '原密码错误'; 
           Yii::app()->end();
        }
        
        if($newpsw == $oldpsw)
        {
            echo '输入的新旧密码相同';
            Yii::app()->end();
        }
        
        $userModel = new Users();
        $attributes = array(
            'password'=>md5($newpsw),
        );
        
        if($userModel->updateByPk(Yii::app()->user->getState('user_id'), $attributes)){
            echo '修改密码成功';
        }
    }
	
	public function actionOwnbook()
	{
	    $memberId = Yii::app()->user->getState('user_id');
	    $ownbookList = $this->getOwnbook($memberId);
	    
	    $this->render('ownbook', array('ownbookList'=>$ownbookList));
	}
	
	public function getOwnbook($memberId){
	    $rows = OwnerBook::model()
	    ->with('book')
	    ->findAll('owner_id = :owner_id', array(':owner_id'=>$memberId));
	    
	    $ownbookList = array();
	    foreach ($rows as $row)
	    {
	        $book = array();
	        $book['image'] = $row->book->cover_path;
	        $book['book_name'] = $row->book->book_name;
	        $book['book_id'] = $row->book->book_id;
	        $book['access'] = $row->access;
	        $ownbookList[] = $book;
	    }
	    
	    return $ownbookList;
	}
	
	/**
	 * @author Javoft
	 * 根据用户的院系信息，初始化用户的课表
	 */
	public function initclass(){
	    $memberId = Yii::app()->user->getState('user_id');
	    //查询出用户所属的院系
	    $user = Users::model()->findByPk($memberId);
	    $majorId = $user->major_id;
	    $grade = $user->grade;
	    //获取该院系的课程
	    $rows = Actualclass::model()
	    ->with('course')
	    ->findAll(array(
    	    'select'=>'class_id',
    	    'condition' =>"major_id = '$majorId' AND grade = $grade",
	        )
	    );
	    
	    //整理数据
	    $myClassList = array();
	    foreach ($rows as $row){
	        $myClass = array();
	        $myClass['actualclass_id'] = $row->class_id;
	        $myClass['class_name'] = $row->course->course_name;
	        $myClass['member_id'] = Yii::app()->user->getState('user_id');
	        foreach ($row->timeSites as $timeSite){
	            $myClass['day'] = $timeSite->day_of_week;
	            $myClass['classroom'] = $timeSite->classroom;
	            $myClass['campus'] = $timeSite->campus;
	            
	            if(trim($timeSite->week_info) == '单周'){
	                $myClass['week_info'] = 'single';
	            }else if(trim($timeSite->week_info) == '双周'){
	                $myClass['week_info'] = 'double';
	            }else{
	                $myClass['week_info'] = 'both';
	            }
	            
	            for($i = $timeSite->begin_time; $i <= $timeSite->end_time; $i++){
	                $myClass['time'] = $i;
	                $myClassList[] = $myClass;
	            }
	        }
	    }
	    
	    //上面的数据插入到myClass表中
	    foreach ($myClassList as $myClass){
	        $myClassModel = new Myclass();
	        $myClassModel->attributes = $myClass;
	        $myClassModel->save($myClass);
	    }
	}
	
	private function getMyClass($userId){
	    $user = Users::model()->findByPk($userId);
	    if($user->major_id){
	        //已经填写了 院系信息
	        $rows = Myclass::model()
	        ->findAll('member_id = :member_id', array(':member_id'=>$userId));
	        if(sizeof($rows) != 0){
	            //如果取出了结果，课表已经初始化
	            $myClassList = array();
	            foreach ($rows as $c){
	                $myClass = array();
	                $myClass['myclass_id'] = $c->myclass_id;
	                $myClass['class_name'] = $c->class_name;
	                $myClass['classroom'] = $c->classroom;
	                $myClass['custom'] = $c->custom;
	                $myClass['time'] = $c->time;
	                $myClass['week_info'] = $c->week_info;
	                $myClass['day'] = $c->day;
	                $myClass['actualclass_id'] = $c->actualclass_id;
	                
                    //position 表示课程在课表中的显示位置
                    $postion = $myClass['day'] - 1 + ($myClass['time'] - 1) * 7;
                    $myClassList[$postion] = $myClass;
	            }
	        }else{
	            //如果没有取出结果，说明还未初始化课表
	            $this->initclass();
	            $rows = Myclass::model()
	            ->findAll('member_id = :member_id', array(':member_id'=>$userId));
    	        if(sizeof($rows) != 0){
    	            //如果取出了结果，课表已经初始化
    	            $myClassList = array();
    	            foreach ($rows as $c){
    	                $myClass = array();
    	                $myClass['myclass_id'] = $c->myclass_id;
    	                $myClass['class_name'] = $c->class_name;
    	                $myClass['classroom'] = $c->classroom;
    	                $myClass['custom'] = $c->custom;
    	                $myClass['time'] = $c->time;
    	                $myClass['week_info'] = $c->week_info;
    	                $myClass['day'] = $c->day;
    	                $myClass['actualclass_id'] = $c->actualclass_id;
    	                
                        //position 表示课程在课表中的显示位置
                        $postion = $myClass['day'] - 1 + ($myClass['time'] - 1) * 7;
                        $myClassList[$postion] = $myClass;
    	            }
    	        }
	        }
	    }else{
	        //没有填写院系信息
	        $errorMsg[] = '没有填写院系信息，请先完善个人信息再使用此功能。';
	    }
	    
	    return $myClassList;
	}
	
	private function getUserInfo($userId){
	    $row = Users::model()
	    ->with('major')
	    ->findByPk($userId);
	    
	    $user = array();
	    $user['username'] = $row->username;
	    $user['user_id'] = $row->user_id;
	    $user['bbs_name'] = $row->bbs_name;
	    $user['major'] = $row->major->major_name;
	    $user['email'] = $row->email;
	    
	    return $user;
	}
	
	private function getLikeCourse($memberId){
	    $rows = LikeCourse::model()
	    ->with('course')
	    ->findAll("member_id = :mid",array(':mid'=>$memberId));
	    //整理数据
	    $likeCourseList = array();
	    foreach ($rows as $row){
	        $likeCourse = array();
	        $likeCourse['course_id'] = $row->course->course_id;
	        $likeCourse['course_name'] = $row->course->course_name;
	        $likeCourse['star'] = $row->star;
	        $likeCourseList[] = $likeCourse;
	    }
	    
	    return $likeCourseList;
	}
	
	private function getUpdownCourse($memberId, $limitnum=false){
	    $rows = CbUpDown::model()
	    ->with(array(
        	        'member'=>array(
                        'condition' => "member_id = $memberId",
        	        ),
        	        'cb.course'=>array(
        	            'select' => 'course_name, course_id',
        	        ),
        	        'cb.book'=>array(
        	            'select' => 'book_name, book_id',
        	        )
        	    )
        	 )
	    ->findAll();
	    //整理数据
	    $updownBookList = array();
	    foreach ($rows as $row){
	        $updownBook = array();
	        $course = array();
	        $book = array();
	        $course['course_name'] = $row->cb->course->course_name;
	        $course['course_id'] = $row->cb->course->course_id;
	        
	        $book['book_name'] = $row->cb->book->book_name;
	        $book['book_id'] = $row->cb->book->book_id;
	        $book['image'] = $book['cover_path'] = $row->cb->book->cover_path;
	        
	        $updownBook['course'] = $course;
	        $updownBook['book'] = $book;
	        
	        $updownBookList[] = $updownBook;
	    }
	    
	    return $updownBookList;
	}
}
