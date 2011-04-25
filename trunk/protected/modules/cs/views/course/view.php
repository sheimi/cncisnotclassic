<?php
$this->breadcrumbs=array(
	'课程'=>array('/cs/course'),
	'查看',
);?>
<script type="text/javascript">
<!--
$(function(){
	$('.up-book').bind('click',function(){
    	$.ajax(
			url:"<?php echo Yii::app()->request->baseUrl . '/index.php?r=members/cbupdown/up'?>",
    	);
    });
	$('.down-book').bind('click',function(){
    	alert("down");
    	$.ajax(
    	);
    });
});

//-->
</script>
<div id="content-left">
<h3 class="result-desc"><?php echo $courseName;?> 的开课详细情况</h3>
        <?php foreach ($actualClassList as $actualClass){?>
        <div class="course-detail">
        	<ul>
        		<li>开课院系：<?php echo $actualClass['major']['major_name'];?></li>
        		<li>开课年级：<?php echo $actualClass['grade']?>级</li>
        		<li>上课教师：
        			<?php if(sizeof($actualClass['teachers'])){?>
        		        <?php $i = 0; foreach ($actualClass['teachers'] as $teacher){if($i){echo ', ';}echo $teacher->teacher_name.$i;}?>
        		    <?php }else{?>
        		    	<?php echo '没有数据';?>
        		    <?php }?>
        		    
        		</li>
        		<li>上课地点：<?php echo $actualClass['site']; ?></li>
        		<li>课程类型：<?php echo $actualClass['course_type'];?></li>
        		<li>学分：<?php echo $actualClass['credit'];?>个</li>
        	</ul>
        </div>
        <?php }?>
</div>
<div id="content-right">
	<div class="side-box">
    	<div class="title">
    		为此课程推荐的参考书
    		<a href="<?php echo Yii::app()->request->baseUrl?>/index.php?r=cs/books/addbook&cid=<?php echo $courseId;?>">我要推荐</a>
    	</div>
    	<?php foreach ($booksList as $book){?>
    	<div class="book-info">
    		 <div class="book-cover">
    			<img src="<?php echo Yii::app()->request->baseUrl;?>/images/100.png" >
    			<div><span booid="<?php echo $book['book_id'];?>" courseid class="up-book">UP</span> <span class="down-book">DOWN</span></div>
    		 </div>
    		 <div class="book-detail">
        		 <div class="book-title"><?php echo $book['book_name'];?></div>
        		 <div>第一推荐人: <?php echo $book['provider_name'];?></div>
        		 <div>
        		 <?php if(!$book['comment']){?>
        		 第一推荐人没有评论此书<br/>
        		 <?php }else{?>
        		 <?php echo $book['comment'];?>
        		 <?php }?>
        		 </div>
        		 <div >
        		 	<a href="<?php echo Yii::app()->request->baseUrl?>/index.php?r=cs/books/viewbook&bid=<?php echo $book['book_id'];?>">查看书籍详情</a>
        		 </div>
        	</div>
        	<div class="clear_float"></div>
    	</div>
    	<?php }?>
	</div>
	<div class="clear_float"></div>
</div>
