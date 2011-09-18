<script type="text/javascript">
<!--
var cid = "<?php echo $courseId?>";
$(function(){
	$('.up').bind('click',function(event){
		var target = $(event.target);
		var cbid = target.attr("cbid");
    	$.ajax({
			url:"<?php echo Yii::app()->request->baseUrl . '/index.php?r=members/cbupdown/up'?>",
			data:"cbid=" + cbid,
			success: function(data, status){
				var msg = '成功推荐此书';
        		$().toastmessage('showToast', {
        		    text     : msg,
        		    sticky   : false,
        		    position : 'top-center',
        		    type     : 'success',
        		    stayTime: 500
        		});
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
        		var msg = '不合适的书就应该把它踩下去';
        		$().toastmessage('showToast', {
        			text     : msg,
        		    sticky   : false,
        		    position : 'top-center',
        		    type     : 'success',
        		    stayTime: 500
        		});
    		}
    	});
    });

	$(".fancybox").fancybox({
	    'centerOnScroll' : 'yes',
	    'transitionIn'   : 'elastic',
	    'transitionOut'  : 'elastic',
	    'overlayOpacity':0.2,
	    'width'			: 560,
	    'autoDimensions' : false,
	    'href':'index.php?r=cs/course/addbook'
	});
    
	$(".likeit").live('click', function(event){
        //喜欢一门课程
        var courseId = cid;
    	$.ajax({
        	url:"<?php echo Yii::app()->request->baseUrl . '/index.php?r=members/likecourse/add'?>",
        	data:{
        		"courseid":courseId,
				'star':5
        	},
			success:function(data, status){
        		$(".likeit").addClass('liked');
    			$(".likeit a").text('已喜欢');
    			$(".likeit").unbind('click');
        		$(".likeit").removeClass('likeit');


			}
    	});
    });

	$('.liked').live('click', function(){
		//取消喜欢一门课程
        var courseId = cid;
    	$.ajax({
        	url:"<?php echo Yii::app()->request->baseUrl . '/index.php?r=members/likecourse/add'?>",
        	data:{
        		"courseid":courseId,
				'star':0
        	},
			success:function(data, status){
        		$(".liked").addClass('likeit');
    			$(".liked a").text('喜欢');
    			$(".liked").unbind('click');
    			$(".liked").removeClass('liked');
    			
			}
    	});
	});
    
});


//-->
</script>
<div id="content-left">
        <div class="course-detail">
        	<?php if($courseStarMy < 4){ ?>
			<h3 class="result-desc"><span class="keyword"><?php echo $courseName;?></span> 开课详情 <span class="likeit cnc-button"><a courseid="<?php echo $courseId;?>">喜欢</a></span></h3>
			<?php }else{ ?>
			<h3 class="result-desc"><span class="keyword"><?php echo $courseName;?></span> 开课详情 <span class="liked cnc-button"><a courseid="<?php echo $courseId;?>">已喜欢</a></span></h3>
			<?php  }?>
            <?php foreach ($actualClassList as $actualClass){?>
        	<div class="rel-course">
            	<ul>
            		<?php if ($actualClass['major']['major_name']){?>
            		<li>开课院系：<?php echo $actualClass['major']['major_name'];?></li>
            		<?php }?>
            		
            		<?php if ($actualClass['grade']){?>
            		<li>开课年级：<?php echo $actualClass['grade']?>级</li>
            		<?php }?>
            		
        			<?php if( sizeof( $actualClass['teachers']) > 0 ){?>
            		<li>上课教师：
            		    <?php $i = 0; foreach ($actualClass['teachers'] as $teacher){if($i++){echo '、 ';}echo $teacher->teacher_name . ' ';}?>
            		</li>
        		    <?php }?>
        		    
        		    <?php if( sizeof( $actualClass['timesite']) > 0 ){?>
                		<li><div style="float:left;">上课时间地点：</div>
            			<br/>
                		<?php foreach ( $actualClass['timesite'] as $timeSite){ ?>
                			<div style="margin-left:70px;"
                			    <?php if($timeSite['conflict']){?>
                				class="time-site-conflict "  title="
                    			    <?php foreach ($timeSite['conflict'] as $c){?>
                    			    <?php echo $c['class_name'].$c['time'].'&nbsp;&nbsp;';?>
                    			    <?php }?>"
                			    <?php }else{?>
                			    		class="time-site"
                			    <?php }?>
                			    >
                    			星期<?php echo $timeSite['day_of_week'];?>
                    			第<?php echo $timeSite['begin_time'];?>到第<?php echo $timeSite['end_time'];?>节课 (<?php echo $timeSite['classroom'];?>)
                			</div>
                		<?php }?>
            		</li>
            		<?php }?>
            		<div class="clear_float"></div>
            		<li>课程类型：<?php echo $actualClass['course_type'];?></li>
            		<li>学分：<?php echo $actualClass['credit'];?>个</li>
            	</ul>
        	</div>
            <?php }?>
        </div>
</div>
<div id="content-right">
	<div class="side-box">
    	<div class="title">
    		为此课程推荐的参考书
    		<span class="add-book">
    			<span class="fancybox cnc-button" cid="<?php echo $courseId;?>"><a>推荐参考书</a></span>
    		</span>
    	</div>
    	<?php foreach ($booksList as $book){?>
    	<div class="book-info">
    		 <div class="book-cover">
    		 	<a href="<?php echo Yii::app()->request->baseUrl . '/index.php?r=cs/books/viewbook&bid=' . $book['book_id'];?>">
    				<img src="<?php echo $book['cover_path'];?>" >
    			</a>
    		 </div>
    		 <div class="book-detail">
        		 <div class="book-title">
        		 	<span  bookid="<?php echo $book['book_id'];?>" cbid="<?php echo $book['cb_id'];?>" class="up">&nbsp;&nbsp;</span>
        		 	<span  bookid="<?php echo $book['book_id'];?>" cbid="<?php echo $book['cb_id'];?>" class="down">&nbsp;&nbsp;</span>
        		 	<span><?php echo $book['book_name'];?></span>
        		 </div>
        		 <div>作者: <?php echo $book['author'];?></div>
        		 <div>出版社：<span class=""><?php echo $book['publisher'];?></span></div>
            	 <div>出版时间：<span class=""><?php echo $book['pubdate'];?></span></div>
        		 <div>推荐者: <?php echo $book['provider_name'];?></div>
        		 <div>
        		 </div>
        	</div>
        	<div class="clear_float"></div>
    	</div>
    	<?php }?>
	</div>
	<div class="clear_float"></div>
</div>
