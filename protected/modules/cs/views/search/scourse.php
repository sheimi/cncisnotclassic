<?php
$this->breadcrumbs=array(
	'Search',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>
<h1 style="color:red">根据课程名字的搜索结果</h1>
<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>



<div>
<h4><?php echo $q; ?>&nbsp;&nbsp;搜索到的结果为：</h4>
<?php if(sizeof($courseList) != 0)foreach ($courseList as $course) {
?>
<div>
	<a href="index.php?r=cs/course/view&cid=<?php echo $course->course_id;?>"><?php echo $course->course_name; ?></a>
	<div>
		<h6>上课详情</h6>
		<ol>
			<li>上课时间地点：XXX</li>
			<li>上课教师：XXX XXX XXX</li>
			<li>开课院系：YYY YYY  YYY  YYY</li>
			<li><a href="">查看课程详情</a>&nbsp;&nbsp;<a href="">关注一下</a></li>
		</ol>
	</div>
</div>
<?php }?>
</div>