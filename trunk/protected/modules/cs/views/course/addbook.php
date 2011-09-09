<!--  弹出添加书籍窗口start -->
<script type="text/javascript">
<!--
$(function(){
	function isISBN(object)
    {
         if(isNaN(object))
         {
              return false;
         }else{
			if(object.length != 13){
				return false;
			}else{
				return true;
			}
         }
     }
	$('#getbookdata').bind('click', function(){
		var isbn = $('#toadd_isbn').val();
		if(isISBN(isbn)){
    		var courseId = cid;
    		$.ajax({
    			url:'index.php?r=cs/course/bookinfo&isbn='+isbn+'&courseId=' + courseId,
    			success:function(data){
    				$('#bookinfo').html(data);
    			}
    		});
		}else{
			alert('请输入13位的合法ISBN号');
			return false;
		}
	});

	$('#toadd_isbn').bind('focus', function(){
		if('ISBN号' == $('#toadd_isbn').val()){
			$('#toadd_isbn').val('');
		}
	});
	
});
//-->
</script>
<div id="addbookwnd">
	<label for="isbn"></label>
	<input name="isbn" id="toadd_isbn" type="text" value="ISBN号" >
	<input type="button" id="getbookdata" value="获取书籍数据">
	<div style="margin:5px;">不知道ISBN号可以到<a href="http://book.douban.com/" target="_blank">豆瓣图书</a>根据书名搜索哦</div>
	<div id="bookinfo">
		<div>
			<img src="images/doubanbook.png">
		</div>
	</div>
</div>
<!--  弹出添加书籍窗口end -->