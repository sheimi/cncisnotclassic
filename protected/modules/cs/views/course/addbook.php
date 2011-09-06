<!--  弹出添加书籍窗口start -->
<script type="text/javascript">
<!--
$(function(){
	$('#getbookdata').bind('click', function(){
		var isbn = $('#toadd_isbn').val();
		var courseId = cid;
		$.ajax({
			url:'index.php?r=cs/course/bookinfo&isbn='+isbn+'&courseId=' + courseId,
			success:function(data){
				$('#bookinfo').html(data);
			}
		});
	});
});
//-->
</script>
<div id="addbookwnd">
	<label for="isbn"></label>
	<input name="isbn" id="toadd_isbn" type="text" value="9787543639133" >
	<input type="button" id="getbookdata" value="获取书籍数据">
	<div id="bookinfo">
	&nbsp;
	</div>
</div>
<!--  弹出添加书籍窗口end -->