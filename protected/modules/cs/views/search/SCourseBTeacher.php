<?php
$this->breadcrumbs=array(
	'Search',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>
<h1 style="color:red">根据教师名字的搜索结果</h1>
<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>



<div>
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