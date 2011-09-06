<?php if(sizeof($courseList) != 0)foreach ($courseList as $course) {?>
<div class="course-detail">
	<div class="class-name">
    	<a href="index.php?r=cs/course/view&cid=<?php echo $course['course_id'];?>"><?php echo $course['course_name']; ?></a>
    	<?php if(isset($course['star'])){?>
    	<span courseid="<?php echo $course['course_id']?>" class="mark-course">评分：<?php echo $course['star'];?></span>
    	<?php }else{?>
    	<span courseid="<?php echo $course['course_id']?>" class="mark-course">关注一下</span>
    	<?php }?>
	</div>
	<div>
		<div>
			<div>
			<?php $i = 0; foreach ($course['major'] as $m){?>
    			<div class="class-brief">
    					<div>
            			<?php
            			 echo '开课院系：' . $m->major_name;
            			 $major_id = $m->major_id;
            			 ?>
    					</div>
            			 <span>上课教师：</span>
            			 
            			 <?php foreach ($course['teachers'][$major_id] as $t){?>
            			 <?php echo $t->teacher_name;?>
            			<?php 
            			 } 
            			 ?> 
    			</div>
			<?php
			} ?>
    		</div>
    		<div class="clear_float"></div>
		</div>
	</div>
</div>
<?php }else{?>
	找不到和您的查询 "<?php echo $q;?>" 相符的内容或信息。
<?php }?>