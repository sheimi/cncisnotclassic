<script type="text/javascript">
$(function(){
	var commentSize = <?php echo $commentPageSize; ?>;
	$("#add-course").fancybox({
	    'width'			: 700,
	    'height'		 : 400,
	    'centerOnScroll' : 'yes',
	    'transitionIn'   : 'elastic',
	    'transitionOut'  : 'elastic',
	    'overlayOpacity':0.2,
	    'autoDimensions' : false,
	    'href':'index.php?r=cs/books/choosecourse'
	});

	$('.ihave-book').hover(function(event){
		$('#book-access').toggle();
	});
	
	$('.havebook').click(function(event){
		var target = $(event.target);
		
		var bookid = target.attr('bookid');
		var access = target.attr('access');
		
		$.ajax({
		  	url: "<?php echo Yii::app()->request->baseUrl . '/index.php?r=members/havebook/add'?>",
		  	data: "bookid=" + bookid + "&" + "access=" + access,
			success: function(data, textStatus){
				alert(data);
				window.location.reload();   
			}
		});
	});

	

	$("#submit-comment").bind('click', function(){
		//提交评论
    	var commentContent = $('#comment-area').val();
		$.ajax({
			url:"<?php echo Yii::app()->request->baseUrl . '/index.php?r=cs/books/addcomment';?>",
			data:"bookid=" + bookid + "&content=" + commentContent,
			type:"post",
			success:function(data){
				var comment = jQuery.parseJSON(data);
				var newComment = createCommentHtml(comment);
				var targetArea = $('#other-comment');
				$('.no-comment').remove();
				targetArea.append(newComment);
				$('#comment-area').val('');
			}
		});
	});

	$("#nextpage").bind('click', function(){
		var target = $(event.target);
		var currentPagenum = target.attr('pagenum');
		var pn = parseInt(currentPagenum) + 1;
		//ajax获取下一页的内容
		$.ajax({
			url:"<?php echo Yii::app()->request->baseUrl . '/index.php?r=cs/books/morecomment'; ?>",
			data:"bookid=" + bookid + "&pagenum=" + pn,
			type:"POST",
			success:function(data){
    			var comments = jQuery.parseJSON(data);

    			if(commentSize < comments.length){
        			for(var c =0; c < comments.length - 1; c++){
            			var newComment = createCommentHtml(comments[c]);
            			var targetArea = $('#other-comment');
            			$('.no-comment').remove();
            			targetArea.append(newComment);
            			$("#nextpage").attr("pagenum", pn)
        			}
    			}else{
    				for(var c =0; c < comments.length; c++){
            			var newComment = createCommentHtml(comments[c]);
            			var targetArea = $('#other-comment');
            			$('.no-comment').remove();
            			targetArea.append(newComment);
            			$("#nextpage").attr("pagenum", pn)
        			}
        			//如果没有最后一个评论，说明没有更多评论，去掉下一页
    				$("#nextpage").fadeOut("slow");
    			}
    		}
		});
		
	});

	$('.up').bind('click',function(event){
		var target = $(event.target);
		var cbid = target.attr("cbid");
    	$.ajax({
			url:"<?php echo Yii::app()->request->baseUrl . '/index.php?r=members/cbupdown/up'?>",
			data:"cbid=" + cbid,
			success: function(data, status){
    			alert(data);
    		}
    	});
    });
    
	$('.down').bind('click',function(event){
		var target = $(event.target);
		var cbid = target.attr("cbid");
    	$.ajax({
			url:"<?php echo Yii::app()->request->baseUrl . '/index.php?r=members/cbupdown/down'?>",
			data:"cbid=" + cbid,
			success: function(data, status){
				alert(data);
    		}
    	});
    });
}
);
var bookid = <?php echo $book['book_id'];?>;
function getMajor(depid){
	$("#course-select-box").fadeOut();
	$.ajax({
		url: "<?php echo Yii::app()->request->baseUrl . '/index.php?r=cs/books/AddRelHelper'?>",
		data: "act=getmajor&" + "depid=" + depid,
		success: function(data){
			var majors = jQuery.parseJSON(data);

			$("#major-select-box").empty();
			var i = 0;
			for(; i < majors.length; i++){
				var major = majors[i];
				$("#major-select-box").append("<span " + "majorid=\"" + major['major_id'] + "\"class=\"selectable-major\">" + major['major_name'] + "</span><span>&nbsp;|&nbsp;</span>");
			}
			if(i == 0){
    			$("#major-select-box").append('<div>下级没有数据</div>');
			}
			$("#major-select-box").append('<div class="clear_float"></div>');
			$("#major-select-box").fadeIn();
			$( "#dialog-form .selectable-major" ).click(
				function (){
					$(this).addClass('selected').siblings().removeClass("selected"); 
					var majorid = $(this).attr('majorid');
					getCourse(majorid);
					disableSubmitCourse();
				}
			);
			
		},
		error: function(data, status){
		}
	});
}te

function getCourse(majorId){
	$.ajax({
		url: "<?php echo Yii::app()->request->baseUrl . '/index.php?r=cs/books/AddRelHelper'?>",
		data: "act=getcourse&" + "majorid=" + majorId,
		success: function(data){
			var courses = jQuery.parseJSON(data);

			$("#course-select-box").empty();
			for(var i = 0; i < courses.length; i++){
				var course = courses[i];
				$("#course-select-box").append("<span " + "courseid=\"" + course['course_id'] + "\" class=\"selectable-course\">" + course['course_name'] + "</span><span>&nbsp;|&nbsp;</span>");
			}
			if(i == 0){
    			$("#course-select-box").append('<div>下级没有数据</div>');
			}
			$("#course-select-box").append('<div class="clear_float"></div>');
			$("#course-select-box").fadeIn();
			$( "#dialog-form .selectable-course" ).click(
					function (){
						$(this).addClass('selected').siblings().removeClass("selected"); 
						$(this).attr({"id":"targetcourse"});
						//课程已经选中，把确定按钮设为可点击
						activeSubmitCourse();
					}
			);
			
		},
		error: function(data, status){
		}
	});
}

function activeSubmitCourse(){
	$("#submit-course").unbind('click');
	$("#submit-course").bind('click', function(){
		var courseid = $("#targetcourse").attr("courseid");
		$.ajax({
		  	url: "<?php echo Yii::app()->request->baseUrl . '/index.php?r=cs/books/addrelcourse'?>",
		  	data: "bookid=" + bookid + "&" + "courseid=" + courseid,
			success: function(data, textStatus){
				alert(data);
				$.fancybox.close();
				window.location.reload();   
			}
		});
	});
	$("#submit-course").fadeIn();
}
function disableSubmitCourse(){
	$("#submit-course").unbind('click');
}

function createCommentHtml(comment){
	var commentHtml = '<div class="clear_float"></div>';
	commentHtml += '<div class="comment">';
 	commentHtml += '<div class="comment-content">';
 	commentHtml += comment['content'];
 	commentHtml += '</div>';
 	commentHtml += '<div class="comment-meta">';
 	commentHtml += "评论者：" + comment['username'] + "评论时间：" + comment['add_time'] + "评价者院系：" + comment['major'];
 	commentHtml += '</div>';
 	commentHtml += '</div>';
	return commentHtml;
}

</script>
	
<div id="content-left" class="viewbook">
    <div class="book">
    	<div class="book-brief">
    		 <div class="book-cover">
        		 <img style="float:left;" src="<?php echo $book['cover_path'];?>" width="101" height="146">
    		 </div>
    		 <div class="book-info">
            	 <div>书名：<span class="book-title"><?php echo $book['book_name'];?></span></div>
            	 <div>作者：<span class="book-title"><?php echo $book['author'];?></span></div>
            	 <div>出版社：<span class="book-title"><?php echo $book['publisher'];?></span></div>
            	 <div>出版时间：<span class="book-title"><?php echo $book['pubdate'];?></span></div>
        		 <div>推荐人: <a href="<?php echo Yii::app()->request->baseUrl . '/index.php?r=members/profile/view&uid=' . $book['provider_id'];?>"><?php echo $book['provider_name'];?></a></div>
        	 </div>
		 	 <div class="clear_float"></div>
		 	 <div class="first-comment">
    		 	<h6>图书添加者对此书的评价：</h6>
    		 	<p>
    		 		<?php echo $book['comment'];?>
    		 	</p>
             </div>
		 	 <div class="clear_float"></div>
         </div>
        		 
		 <div class="clear_float"></div>
		 <div class="other-comment" id="other-comment">
    		 <?php if(!$bookComments){?>
        		 <div class="comment no-comment">
        		 	还没有人对这本书做评价，沙发吧<br/>
        		 </div>
    		 <?php }else{
    		     for ($i = 0; $i < $commentPageSize && isset($bookComments[$i]); $i++){
    		         $comment = $bookComments[$i];
    		 ?>
    		 
    		 <div class="comment">
    		 	<div class="comment-content">
    		 	    <?php echo $comment['content'];?>
    		 	</div>
    		 	<div class="comment-meta">
    		 	评论者：<?php echo $comment['major']?> <a href="<?php echo Yii::app()->request->baseUrl . '/index.php?r=members/profile/view&uid=' . $comment['user_id'];?>"><?php echo $comment['username']?></a>&nbsp;&nbsp;&nbsp;评论时间：<?php echo $comment['add_time'];?> 
    		 	</div>
    		 </div>
    		 <?php 
    		     }
    		 }?>
		 </div>
		 <div class="clear_float"></div>
		 <?php if(isset($bookComments[$i])){?>
		 	<div pagenum="0" id="nextpage">更多评论...</div>
		 <?php }?>
		 <div class="clear_float"></div>
		 <div id="add-comment">
		 	<div id="content">
		 		<textarea id="comment-area"></textarea>
		 	</div>
		 	<div class="clear_float"></div>
		 	<button id="submit-comment">提交书籍评价</button>
		 </div>
    </div>
</div>

<div id="content-right" class="viewbook">
	<div class="side-box">
		<?php if($relCourse){?>
    	<div class="title"><span>相关的NJU课程</span><span class="add_course" id="add-course"><a>推荐课程</a></span></div>
    	<?php foreach ($relCourse as $course) {
        ?>
    	<div class="course-name">
    		<span cbid="<?php echo $course['cb_id'];?>" class="up">&nbsp;&nbsp;</span><span cbid="<?php echo $course['cb_id'];?>" class="down">&nbsp;&nbsp;</span><a href="<?php echo Yii::app()->request->baseUrl . '/index.php?r=cs/course/view&cid=' . $course['course_id'];?>"><?php echo $course['course_name'];?></a>
    	</div>
    	<?php }
    	}?>
	</div>
	
	<div class="side-box">
		<div class="title">这些Njuer有这本书
		<div class="ihave-book">
    		<div bookid="<?php echo $book['book_id']; ?>" id="ihave"><a>我有此书</a></div>
    		<div id="book-access">
        		<div bookid="<?php echo $book['book_id']; ?>" access="borrow" class="havebook">可借</div>
        		<div bookid="<?php echo $book['book_id']; ?>" access="sell" class="havebook">可卖</div>
        		<div bookid="<?php echo $book['book_id']; ?>" access="private" class="havebook">私有</div>
        	</div>
    	</div>
		
		</div>
    	<?php if($ownerList){foreach ($ownerList as $owner){?>
    	<div style="float:left;margin:5px;" >
    		 <!-- 
    		 <img style="float:left;" src="<?php echo Yii::app()->request->baseUrl;?>/images/<?php echo $owner['avatar_path'];?>" width="50" height="50">
    		  -->
    		  <a href="<?php echo Yii::app()->request->baseUrl . '/index.php?r=members/profile/view&uid=' . $owner['owner_id'];?>"><?php echo $owner['owner_name'];?></a>
    	</div>
    	<?php }
    	}else{
    	?>
    	<div style="float:left;margin:5px;" >
    		 暂时还没有人把这本书标记为有
    	</div>
    	<?php }?>
    	<div class="clear_float"></div>
	</div>
</div>
