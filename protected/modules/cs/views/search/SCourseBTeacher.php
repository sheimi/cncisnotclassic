<?php
$this->breadcrumbs=array(
	'搜索',
);?>

<div id="content-left">
	<?php echo $this->renderPartial('../search-box', array('model'=>$model)); ?>
	<h3 class="result-desc"><span class="keyword"><?php echo $q;?></span>的搜索结果</h3>
    <?php if(sizeof($teacherList) != 0)foreach ($teacherList as $teacher) {?>
    	<div class="teacher-course">
            <h4 class="teacher_name">教师<a href="#"><?php echo $teacher['t_name'];?></a>任教的课程</h4>
            <div class="course-name">
            <?php if(sizeof($teacher['courses']) != 0){?>
                <?php foreach ($teacher['courses'] as $t_course){?>
                	<div>
                    	<a href="index.php?r=cs/course/view&cid=<?php echo $t_course->course_id;?>"><?php echo $t_course->course_name; ?></a>
                    </div>
                <?php }?>
                <div class="clear_float"></div>
   			 <?php }else{?>
   			 	<div>暂时没有结果</div>
   			 <?php }?>
        	</div>
        	<div class="clear_float"></div>
    	</div>
    <?php }?>
</div>
<div id="content-right">
	<div class="side-box">
		<div class="title">搜索量最大的老师</div>
		dsafds<br>
		dsafds<br>
		dsafds<br>
		dsafds<br>
		dsafds<br>
	</div>
	<div class="side-box">
		<div class="title">最受学生欢迎的老师</div>
		dsafds<br>
		dsafds<br>
		dsafds<br>
		dsafds<br>
		dsafds<br>
	</div>
</div>