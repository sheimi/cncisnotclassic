<?php
$this->breadcrumbs=array(
	'搜索',
);?>

<div id="content-left">
    <?php if(sizeof($teacherList) != 0)foreach ($teacherList as $teacher) {
    ?>
    <h4 class="teacher_name">教师<a href="#"><?php echo $teacher['t_name'];?></a>任教的课程</h4>
    <?php if(sizeof($teacher['courses']) != 0){?>
    <?php foreach ($teacher['courses'] as $t_course){?>
    <div>
    <a href="index.php?r=cs/course/view&cid=<?php echo $t_course->course_id;?>"><?php echo $t_course->course_name; ?></a>
    </div>
    <?php }?>
    <?php 
    }
    }?>
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