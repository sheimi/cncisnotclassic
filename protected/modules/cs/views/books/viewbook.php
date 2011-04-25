<?php
$this->breadcrumbs=array(
	'课本'=>array('/cs/books'),
	'查看课本',
);?>

<script type="text/javascript">
$(function(){
	$( "#dialog:ui-dialog" ).dialog( "destroy" );
	$( "#dialog-form" ).dialog({
		autoOpen: false,
		height: 500,
		width: 650,
		modal: true,
		close: function() {
			allFields.val( "" ).removeClass( "ui-state-error" );
		}
	});

	$("#add-book")
    	.click(function() {
    		$( "#dialog-form" ).dialog( "open" );
	});

	$( "#dialog-form .selectable" ).click(
		function (){
			$(this).addClass('selected').siblings().removeClass("selected"); 
			var depId = $(this).attr('depid');
			getMajor(depId);
			$('#course-select-box').empty();
			disableSubmitCourse();
		}
	);

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
				targetArea.append(newComment);
			}
		});
	});
}
);
var bookid = <?php echo $book['book_id'];?>;
function getMajor(depid){
	$.ajax({
		url: "<?php echo Yii::app()->request->baseUrl . '/index.php?r=cs/books/AddRelHelper'?>",
		data: "act=getmajor&" + "depid=" + depid,
		success: function(data){
			var majors = jQuery.parseJSON(data);

			$("#major-select-box").empty();
			for(var i = 0; i < majors.length; i++){
				var major = majors[i];
				$("#major-select-box").append("<span " + "majorid=\"" + major['major_id'] + "\"class=\"selectable-major\">" + major['major_name'] + "</span><span>&nbsp;|&nbsp;</span>");
			}

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
}

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
		alert('activeSubmitCourse');
		var courseid = $("#targetcourse").attr("courseid");
		$.ajax({
		  	url: "<?php echo Yii::app()->request->baseUrl . '/index.php?r=cs/books/addrelcourse'?>",
		  	data: "bookid=" + bookid + "&" + "courseid=" + courseid,
			success: function(data, textStatus){
				alert(data);
			}
		});
	});
}
function disableSubmitCourse(){
	$("#submit-course").unbind('click');
}
function createMajorblok(){
	
}

function createCommentHtml(comment){
	var commentHtml = '<div class="clear_float"></div>';
	commentHtml += '<div class="comment">';
	commentHtml += '<p>';
 	commentHtml += comment['content'];
 	commentHtml += '</p>';
 	commentHtml += "<p>评论者：" + comment['username'] + "评论时间：" + comment['add_time'] + "评价者院系：" + comment['major'] + "</p>";
 	commentHtml += "<p>评分：" + comment['star'] + "</p>";
 	commentHtml += '</div>';
	return commentHtml;
}

</script>
	
<div id="content-left" class="viewbook">
    <div class="book">
    	<div class="book-brief">
    		 <div class="book-cover">
        		 <img style="float:left;" src="<?php echo Yii::app()->request->baseUrl;?>/images/100.png" width="100" height="100">
    		 </div>
    		 <div class="book-info">
            	 <div>书名：<span class="book-title"><?php echo $book['book_name'];?></span></div>
            	 <div>作者：<span class="book-title"><?php echo $book['book_name'];?></span></div>
            	 <div>出版社：<span class="book-title"><?php echo $book['book_name'];?></span></div>
            	 
        		 <div>第一推荐人: <?php echo $book['provider_name'];?></div>
        		 
        		 <div>封面提供者: <?php echo '华挺';?></div>
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
        		 <div class="comment">
        		 	还没有人对这本书做评价，沙发吧<br/>
        		 </div>
        		 <div class="comment">
        		 	还没有人对这本书做评价，沙发吧<br/>
        		 </div>
        		 <div class="comment">
        		 	还没有人对这本书做评价，沙发吧<br/>
        		 </div>
    		 <?php }else{
    		     foreach ($bookComments as $comment){
    		 ?>
    		 <div class="clear_float"></div>
    		 <div class="comment">
    		 	<p>
    		 	<?php echo $comment['content'];?>
    		 	</p>
    		 	<p>评论者：<?php echo $comment['username']?>；评论时间：<?php echo $comment['add_time'];?> 评价者院系：<?php echo $comment['major']?></p>
    		 	<p>评分：<?php echo $comment['star'];?></p>
    		 </div>
    		 <?php 
    		     }
    		 }?>
		 </div>
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
    	<div class="title"><span>相关的NJU课程</span><span class="add-book" id="add-book"><a>推荐课程</a></span></div>
    	<?php foreach ($relCourse as $course) {
        ?>
    	<div>
    	<a href="<?php echo Yii::app()->request->baseUrl . '/index.php?r=cs/course/view&cid=' . $course['course_id'];?>"><?php echo $course['course_name'];?></a>
    	</div>
    	<?php }
    	}?>
	</div>
	
	<!--  弹出窗口中根据院系选择课程和书籍产生联系start -->
	<div id="add">
    	<form id="dialog-form">
    		<h1>为XXX书添加一门相关课程</h1>
    		<div class="selection-box">
    			<?php foreach ($deps as $dep) {?>
    			<span depid="<?php echo $dep['dep_id']?>" class="selectable"><?php echo $dep['dep_name']; ?></span><span>&nbsp;|&nbsp;</span>
    			<?php }?>
    		</div>
    		<div class="clear_float"></div>
    		<div id="major-select-box">
    			
    		</div>
    		<div class="clear_float"></div>
    		<div id="course-select-box">
    			
    		</div>
    		<div class="clear_float"></div>
    		<div id="submit-course">确认推荐</div>
    	</form>
	</div>
	<!--  弹出窗口中根据院系选择课程和书籍产生联系end -->

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
    		 <img style="float:left;" src="<?php echo Yii::app()->request->baseUrl;?>/images/<?php echo $owner['avatar_path'];?>" width="50" height="50">
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
