<script type="text/javascript">
<!--
$(function(){
	$('#confirm_book').bind('click', function(){
		var isbn = '<?php echo $bookinfo['isbn13']; ?>';
		$.ajax({
			url:'index.php?r=cs/course/confirmbook&isbn='+isbn + '&courseId='+cid,
			success:function(data){
				alert(data);
				$.fancybox.close();
				window.location.reload();   
			}
		});
	});
});
//-->
</script>
<div class="newFancy_bookInfo"><img
	src="<?php echo $bookinfo['image'];?>"
	class="newFancy_bookInfo_cover">
    <ul class="newFancy_bookInfo_ul">
    	<li class="newFancy_bookInfo_ul_name"><?php echo $bookinfo['title']?></li>
    	<li>ISBN：<?php echo $bookinfo['isbn13'];?></li>
    	<li>作者：<?php echo $bookinfo['author'];?></li>
    	<li>出版社：<?php echo $bookinfo['publisher'];?></li>
    	<li>出版时间：<?php echo $bookinfo['pubdate'];?></li>
    	<li>定价：<?php echo $bookinfo['price'];?></li>
    </ul>
    
    <input type="button" id="confirm_book" value="确认" />
</div>