<?php
$this->breadcrumbs=array(
	'搜索',
);?>
<script type="text/javascript">
$(function(){
    $(".mark-course").bind('click', function(event){
        //关注一门课程
        var target = $(event.target);
        var courseId = target.attr('courseid');
    	$.ajax({
        	url:"<?php echo Yii::app()->request->baseUrl . '/index.php?r=members/likecourse/add'?>",
        	data:"courseid=" + courseId,
			success:function(data, status){
				alert(data);
			}
    	});
    });
});
</script>
<div id="content-left" class="scourse">
	<?php echo $this->renderPartial('../search-box', array('q'=>$q)); ?>
    <h3 class="result-desc"><span class="keyword"><?php echo $q; ?></span>&nbsp;&nbsp;搜索到的结果为：</h3>
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
        		<div class="mark"><a href="">查看课程详情</a></div>
        		<div class="clear_float"></div>
    		</div>
    	</div>
    </div>
    <?php }?>
</div>

<div id="content-right">
	<div class="side-box">
		<div class="title">关注度最高的课程</div>
		<ol>
			<?php $i = 1; foreach ($favCourseList as $course){?>
				<?php if($i > 10){?>
				<li class="top20">
				<?php }else{?>
				<li>
				<?php }?>
					<a href="<?php echo Yii::app()->request->baseUrl . '/index.php?r=cs/course/view&cid='. $course['course_id'];?>">
					    <?php echo $course['course_name'];$i++;?>
					</a>
					(<?php echo $course['course_fans'];?>)
				</li>
			<?php }?>
		</ol>
	</div>
</div>