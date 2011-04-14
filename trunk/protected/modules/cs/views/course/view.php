<?php
$this->breadcrumbs=array(
	'Course'=>array('/cs/course'),
	'View',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>
<h1>用来展示每门Course的详细信息，分院系显示，每个条目是一个Actualclass，包含上课老师信息，上课地点，上课时间</h1>
<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
	
	
</p>
<div style="width:500px;float:left;">
<?php foreach ($actualClassList as $actualClass){?>
	<ul>
		<li>开课院系：<?php echo $actualClass['major']['major_name'];?></li>
		<li>开课年级：<?php echo $actualClass['grade']?>级</li>
		<li>上课教师：<?php $i = 0; foreach ($actualClass['teachers'] as $teacher){if($i){echo ', ';}echo $teacher->teacher_name;;}?></li>
		<li>上课地点：<?php echo $actualClass['site']; ?></li>
		<li>课程类型：<?php echo $actualClass['course_type'];?></li>
		<li>学分：<?php echo $actualClass['credit'];?>个</li>
	</ul>
<?php }?>
</div>
<div style="float:left;background:#aaa;">
	<h1>学长学姐为此课程推荐的参考书</h1>
	<h2><a href="<?php echo Yii::app()->request->baseUrl?>/index.php?r=cs/books/addbook&cid=<?php echo $courseId;?>">我来推荐一本书</a></h2>
	<?php foreach ($booksList as $book){?>
	<div>
		 <img style="float:left;" src="<?php echo Yii::app()->request->baseUrl;?>/images/100.png" width="100" height="100">
		 <h5></h5>
		 <div>第一推荐人: <?php echo $book['provider_name'];?></div>
		 <div>
		 <?php if(!$book['comments']){?>
		 还没有人对这本书做评价，沙发吧<br/>还没有人对这本书做评价，沙发吧<br/>还没有人对这本书做评价，沙发吧<br/>还没有人对这本书做评价，沙发吧<br/>
		 <?php }else{?>
		 <?php echo '这本书的评价';?>
		 <?php }?>
		 </div>
		 <div ><a href="<?php echo Yii::app()->request->baseUrl?>/index.php?r=cs/books/viewbook&bid=<?php echo $book['book_id'];?>">查看书籍详情</a></div>
	</div>
	<div class="clear_float"></div>
	<?php }?>
	<div>
		 <img style="float:left;" src="<?php echo Yii::app()->request->baseUrl;?>/images/100.png" width="100" height="100">
		 <h5>这是书籍的名字</h5>
		 <div>第一推荐人: 华挺</div>
		 <div>还没有人对这本书做评价，沙发吧<br/>还没有人对这本书做评价，沙发吧<br/>还没有人对这本书做评价，沙发吧<br/>还没有人对这本书做评价，沙发吧<br/></div>
		 <div ><a>查看书籍详情</a></div>
	</div>
	<div class="clear_float"></div>
</div>
