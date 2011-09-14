<?php

class CourseController extends Controller
{
	public function accessRules()
	{
		return array (//这只该Controller下面对应的所有Action未登录用户都不能访问
		array ('deny', 'actions' => array (), 'users' => array ('?' ) ) );
	}
	
	// Uncomment the following methods and override them if needed
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array ('accessControl' );
	}
	public function actionView($cid)
	{
		$memberId = Yii::app ()->user->getState ( 'user_id' );
		$courseId = $cid;
		
		//查处课程信息
		$row = Course::model ()->findByPk ( $courseId );
		$courseDetail ['course_id'] = $row->course_id;
		$courseDetail ['course_name'] = $row->course_name;
		
		// 需要选择出 院系信息
		$rows = Actualclass::model ()->with ( //一门课可能有多个老师
array ('teachers' => array ('select' => 'teacher_id, teacher_name' ) ) )->with ( //一门Actualclass 只可能是一个院系的
array ('major' => array ('select' => 'major_id, major_name' ) ) )->findAll ( "course_id = :course_id", array (':course_id' => $courseId ) );
		
		//整理数据
		$actualClassList = array ();
		foreach ( $rows as $row )
		{
			$actualClass = array ();
			$actualClass ['major'] = array ('major_id' => $row->major->major_id, 'major_name' => $row->major->major_name );
			
			//上课的年级
			$actualClass ['grade'] = $row->grade;
			
			//该院系这门课的教师信息
			$actualClass ['teachers'] = $row->teachers;
			
			//上课的时间和地点 粗略
			$actualClass ['site'] = $row->site;
			
			//该门课程在该院系的类型（核心or选修）
			$actualClass ['course_type'] = $row->course_type;
			
			//这门课在这个院系的学分数
			$actualClass ['credit'] = $row->credit;
			
			//上课的时间和地点，从time_site中获取
			$classId = $row->class_id;
			
			$rows = TimeSite::model ()->findAll ( 'class_id = :class_id', array (':class_id' => $classId ) );
			
			//整理time_site
			$timeSiteList = array ();
			foreach ( $rows as $row )
			{
				$timeSite = array ();
				$timeSite ['classroom'] = $row->classroom;
				$timeSite ['campus'] = $row->campus;
				$timeSite ['day_of_week'] = $row->day_of_week;
				$timeSite ['begin_time'] = $row->begin_time;
				$timeSite ['end_time'] = $row->end_time;
				
				//判断一下这节课是否和当前用户的课程有冲突
				$myclassRows = Myclass::model ()->findAll ( 'day = :day AND time >= :begin_time AND time<= :end_time AND member_id = :member_id', array (':day' => $timeSite ['day_of_week'], ':begin_time' => $timeSite ['begin_time'], ':end_time' => $timeSite ['end_time'], ':member_id' => $memberId ) );
				
				$conflict = array ();
				if ($myclassRows)
				{
					foreach ( $myclassRows as $myclassRow )
					{
						$myclass = array ();
						$myclass ['class_name'] = $myclassRow->class_name;
						$myclass ['custom'] = $myclassRow->custom;
						$myclass ['time'] = $myclassRow->time;
						$conflict [] = $myclass;
					}
				}
				$timeSite ['conflict'] = $conflict;
				$timeSiteList [] = $timeSite;
			}
			
			$actualClass ['timesite'] = $timeSiteList;
			$actualClassList [] = $actualClass;
		}
		
		//下面获取推荐的书籍
		$relBookNum = 10;
		$booksList = $this->getRelBook ( $courseId, $relBookNum );
		
		//获取当前用户对这本书的评分和其他用户对这本书的评分
		$row = LikeCourse::model ()->findByAttributes ( array ('member_id' => $memberId, 'course_id' => $courseId ) );
		if ($row)
		{
			$courseStarMy = $row->star;
		} else
		{
			$courseStarMy = 0;
		}
		
		$this->render ( 'view', array ('actualClassList' => $actualClassList, 'booksList' => $booksList, 'courseId' => $courseId, 'courseName' => $courseDetail ['course_name'], 'courseStarMy' => $courseStarMy ) );
	}
	
	/**
	 * @author javoft
	 * @param unknown_type $courseId
	 * 根据课程id，获取books，books 根据up desc顺序排序
	 */
	private function getRelBook($courseId, $num)
	{
		$sql = "SELECT  COUNT(cb_up_down_id) up_total, cb_id, b.*, u.* ";
		$sql .= "FROM cb_up_down cbud ";
		$sql .= "JOIN course_book cb ON cb.`c_b_id` = cbud.`cb_id` ";
		$sql .= "JOIN books b ON b.`book_id` = cb.`book_id` ";
		$sql .= "JOIN users u ON u.user_id = b.`provider` ";
		$sql .= "WHERE cb.`course_id` = '$courseId' ";
		$sql .= "GROUP BY cb.`book_id` ";
		$sql .= "ORDER BY up_total DESC ";
		$sql .= "LIMIT $num";
		
		$db = Yii::app ()->db;
		$cmd = $db->createCommand ( $sql );
		$rows = $cmd->queryAll ();
		
		//整理数据
		$bookList = array ();
		foreach ( $rows as $row )
		{
			$book = array ();
			$book ['cb_id'] = $row ['cb_id'];
			$book ['book_id'] = $row ['book_id'];
			$book ['book_name'] = $row ['book_name'];
			$book ['publisher'] = $row ['publisher'];
			$book ['pubdate'] = $row ['pubdate'];
			$book ['author'] = $row ['author'];
			
			$book ['cover_path'] = $book ['image'] = $row ['cover_path'];
			$book ['up_total'] = $row ['up_total'];
			$book ['provider_name'] = $row ['username'];
			$book ['provider_id'] = $row ['user_id'];
			$book ['comment'] = $row ['comment'];
			$book ['update_time'] = $row ['update_time'];
			
			$bookList [] = $book;
		
		}
		return $bookList;
	}
	
	public function actionAddbook()
	{
		$this->renderPartial ( 'addbook' );
	}
	
	public function actionBookinfo($isbn)
	{
		$bookinfo = $this->getBookinfoFromDouban ( $isbn );
		$this->renderPartial ( 'bookinfo', array (

		'bookinfo' => $bookinfo ) );
	}
	
	public function actionConfirmbook($isbn, $courseId)
	{
		$bookinfo = $this->getBookinfoFromDouban ( $isbn );
		if ($book = Books::model ()->find ( 'isbn=:isbn', array (':isbn' => $isbn ) ))
		{
			$memberId = Yii::app ()->user->getState ( 'user_id' );
			//此书已经存在
			

			//设置关联关系
			//1、 检查关联关系是否存在
			$attributes = array ('book_id' => ($book->book_id + 0), 'course_id' => $courseId, 'recommender_id' => ($memberId + 0) );
			
			if (CourseBook::model ()->findByAttributes ( $attributes ))
			{
				//关联关系已经存在
				echo '此书已经有人推荐过';
			} else
			{
				//2、 添加关联关系
				$model = new CourseBook ();
				$model->attributes = $attributes;
				if ($model->save ())
				{
					$cbudModel = new CbUpDown ();
					$cbudModel->attributes = array ('cb_id' => $model->c_b_id, 'updown' => 'up', 'member_id' => $memberId );
					$cbudModel->save ();
					echo '推荐成功';
				}
			}
		} else
		{
			//此书还未添加过
			$memberId = Yii::app ()->user->getState ( 'user_id' );
			//1、 获取书记信息添加到数据库
			$bookinfo = $this->getBookinfoFromDouban ( $isbn );
			$newBook = array ();
			$newBook ['book_name'] = $bookinfo ['title'];
			$newBook ['isbn'] = $bookinfo ['isbn13'];
			$newBook ['provider'] = $memberId;
			$t = split('.',  $bookinfo['image']);
		    $fileExt = $t[sizeof($t) - 1];
			// TODO 将图片保存到本地
			
//			function downloadFile($url, $savePath, $name = '')
//			{
//				if ($name == '')
//				{
//					$header = get_headers ( $url, 1 );
//					// 如果链接进行过跳转则匹配 location 之后的链接中的文件名
//					if (isset ( $header ['Location'] ))
//					{
//						$name = basename ( str_replace ( strstr ( $header ['Content-Type'] [1], '?' ), '', $header ['Location'] ) );
//						// 如果没有找到文件名则自动以当前时间为名称
//						$name = ($name == '') ? time () . str_replace ( '/', '', strstr ( $header ['Content-Type'] [1], '/' ) ) : $name;
//					} else
//					{
//						$name = basename ( str_replace ( strstr ( $header ['Content-Type'], '?' ), '', $url ) );
//					}
//				}
//				
//				return file_put_contents ( $savePath . DIRECTORY_SEPARATOR . $name, file_get_contents ( $url ) );
//			
//			}
//			
//			$day = date('y-m-j');
//			if (!file_exists($day)){
//			    mkdir($day);
//			}
//			$filename = $newBook ['isbn'].time(). '.' . $fileExt;
//			$savePath = $bookCoverPath . "$day" . DIRECTORY_SEPARATOR . "$filename";
//			downloadFile($bookinfo ['image'], '$savePath', $filename);
			
//			$newBook ['cover_path'] = $savePath . DIRECTORY_SEPARATOR . $filename;
			$newBook ['cover_path'] = $bookinfo['image'];	
			$newBook ['author'] = $bookinfo ['author'];
			$newBook ['publisher'] = $bookinfo ['publisher'];
			$newBook ['comment'] = '';
			$newBook ['pubdate'] = $bookinfo ['pubdate'];
			$newBook ['price'] = $bookinfo ['price'];
			
			$bookModel = new Books ();
			$bookModel->attributes = $newBook;
			if ($bookModel->save ())
			{
				//2、设置关联关系 
				$attributes = array ('book_id' => ($bookModel->book_id + 0), 'course_id' => $courseId, 'recommender_id' => ($memberId + 0) );
				
				$cbModel = new CourseBook ();
				$cbModel->attributes = $attributes;
				if ($cbModel->save ())
				{
					$cbudModel = new CbUpDown ();
					$cbudModel->attributes = array ('cb_id' => $cbModel->c_b_id, 'updown' => 'up', 'member_id' => $memberId );
					if ($cbudModel->save ())
					{
						echo '推荐成功';
					} else
					{
						echo '推荐失败';
					}
				} else
				{
					echo '推荐失败';
				}
			}
		}
	}
	
	public function actionRating()
	{
		$rate = $_POST ['rate'];
		$courseId = $_GET ['courseId'];
		$likecourseModel = new LikeCourse ();
		$memberId = Yii::app ()->user->getState ( 'user_id' );
		$attributes = array ('member_id' => $memberId, 'course_id' => $courseId );
		
		if ($rows = LikeCourse::model ()->findAllByAttributes ( $attributes ))
		{
			$attributes = array ('member_id' => $memberId, 'course_id' => $courseId, 'star' => $rate );
			
			foreach ( $rows as $row )
			{
				$row->attributes = $attributes;
				$row->update ();
			}
		} else
		{
			$attributes = array ('member_id' => $memberId, 'course_id' => $courseId, 'star' => $rate );
			$likecourseModel->attributes = $attributes;
			$likecourseModel->save ();
		}
	}
	public function getBookinfoFromDouban($isbn)
	{
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, 'http://api.douban.com/book/subject/isbn/' . $isbn );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		$data = curl_exec ( $ch );
		curl_close ( $ch );
		if ($data)
		{
			$bookinfo = $this->parseXml ( $data );
		} else
		{
			$bookinfo = false;
		}
		
		return $bookinfo;
	}
	
	public function parseXml($data)
	{
		$doc = new DOMDocument ();
		$doc->loadXML ( $data );
		$bookinfo = array ();
		$xpath = new DOMXPath ( $doc );
		$root = $doc->documentElement;
		$authors = array ();
		
		$bookinfo ['image'] = $xpath->query ( '/link', $root );
		foreach ( $doc->getElementsByTagName ( 'link' ) as $link )
		{
			$bookinfo [$link->getAttribute ( 'rel' )] = $link->getAttribute ( 'href' );
		}
		
		foreach ( $doc->getElementsByTagName ( 'attribute' ) as $db_attr )
		{
			$bookinfo [$db_attr->getAttribute ( 'name' )] = $db_attr->nodeValue;
		}
		return $bookinfo;
	}
}