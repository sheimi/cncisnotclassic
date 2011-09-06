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
<?php }else{?>
	找不到和您的查询 "<?php echo $q;?>" 相符的内容或信息。
<?php }?>