<!--  弹出窗口中根据院系选择课程和书籍产生联系start -->
<script type="text/javascript">
<!--
$(function(){
	$( "#dialog-form .selectable" ).click(
	function (){
		$(this).addClass('selected').siblings().removeClass("selected"); 
		var depId = $(this).attr('depid');
		getMajor(depId);
		$('#course-select-box').empty();
		disableSubmitCourse();
	});
});
//-->
</script>
<div id="add">
	<form id="dialog-form">
		<h1>为<span class="keyword"><?php echo $book['book_name'];?></span>添加一门相关课程</h1>
		<div class="selection-box">
			<?php foreach ($deps as $dep) {?>
			<span depid="<?php echo $dep['dep_id']?>" class="selectable"><?php echo $dep['dep_name']; ?></span><span>&nbsp;|&nbsp;</span>
			<?php }?>
			<div class="clear_float"></div>
		</div>
		<div class="clear_float"></div>
		<div id="major-select-box" style="display:none;">
			
		</div>
		<div class="clear_float"></div>
		<div id="course-select-box"  style="display:none;">
			
		</div>
		<div class="clear_float"></div>
		<div style="display:none;" id="submit-course">确认推荐</div>
	</form>
</div>
<!--  弹出窗口中根据院系选择课程和书籍产生联系end -->