<?php
$this->breadcrumbs=array(
	'搜索',
);?>
<div id="content-left">
    <h3 class="result-desc"><?php echo $q; ?>&nbsp;&nbsp;搜索到的结果为：</h3>
    <?php if(sizeof($courseList) != 0)foreach ($courseList as $course) {
    ?>
    <div class="course-detail">
    	<div class="class-name">
        	<a href="index.php?r=cs/course/view&cid=<?php echo $course['course_id'];?>"><?php echo $course['course_name']; ?></a>
    	</div>
    	<div class="more-detail"><a href="">查看课程详情</a></div>
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
        		<div class="mark"><a href="">查看课程详情</a>&nbsp;&nbsp;<a href="">关注一下</a></div>
        		<div class="clear_float"></div>
    		</div>
    	</div>
    </div>
    <?php }?>
</div>

<div id="content-right">
	<div class="side-box">
		<div class="title">你说在院系动态</div>
		dsafds<br>
		dsafds<br>
		dsafds<br>
		dsafds<br>
		dsafds<br>
	</div>
	<div class="side-box">
		<div class="title">你说在院系动态</div>
		dsafds<br>
		dsafds<br>
		dsafds<br>
		dsafds<br>
		dsafds<br>
	</div>
	<div class="side-box">
		<div class="title">你说在院系动态</div>
		dsafds<br>
		dsafds<br>
		dsafds<br>
		dsafds<br>
		dsafds<br>
	</div>
</div>