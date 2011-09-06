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

	$(".fancybox").fancybox({
	    'centerOnScroll' : 'yes',
	    'transitionIn'   : 'elastic',
	    'transitionOut'  : 'elastic',
	    'overlayOpacity':0.2,
	    'href':'index.php?r=cs/course/addbook'
	});
    
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

	//根据以前的评分设置星评值
	var rating = <?php echo $courseStarMy;?>?<?php echo $courseStarMy;?>:0;
	if(rating != 0){
		//设置星评值
		var ratedStar = ".star-" + rating;
		var w = (rating * 30) + "px";
		$(ratedStar).addClass("rated").css("width",w);
	}
	
	$(".rate-course").bind("mouseover", function(){
		$(".rated").removeClass("rated").removeAttr('style');
	});
	
	$(".rate-course").bind("mouseout", function(){
		var ratedStar = ".star-" + rating;
		var w = (rating * 30) + "px";
		$(ratedStar).addClass("rated").css("width",w);
	});

	$(".star").bind('click', function(){
		$(".rated").removeClass("rated");
		var target = $(event.target);
		var star = target.attr("rating");
		$.ajax({
			url:"<?php  echo Yii::app()->request->baseUrl."/index.php?r=members/likecourse/add";?>",
			data:"star="+star+"&cid="+cid,
			type:"POST",
			success:function(data){
				rating = star;
			}
		});
	});

	<?php if(!$courseStarMy){ ?>
	$('.jRating').jRating({
		 length : 5,
		 type : 'big',
		 showRateInfo: true,
		 rateMax: 5, 
		 phpPath: 'index.php?r=cs/course/rating&courseId='+<?php echo $courseId;?>
	});
	<?php }?>
});


//-->
</script>
<div id="content-left">
        <div class="course-detail">
			<h3 class="result-desc"><span class="keyword"><?php echo $courseName;?></span> 开课详情
			</h3>
            <?php foreach ($actualClassList as $actualClass){?>
        	<div class="rel-course">
        		<?php if($courseStarMy){?>
        		<span>我的评分：<?php echo $courseStarMy;?>分</span>
        		<span>平均分：<?php echo $avagStar;?>分</span>
        		<?php }else{?>
    			<span class="jRating rate-course" data="12_1"></span>
    			<?php }?>
            	<ul>
            		<li>开课院系：<?php echo $actualClass['major']['major_name'];?></li>
            		<li>开课年级：<?php echo $actualClass['grade']?>级</li>
            		<li>上课教师：
            			<?php if(sizeof($actualClass['teachers'])){?>
            		        <?php $i = 0; foreach ($actualClass['teachers'] as $teacher){if($i++){echo '、 ';}echo $teacher->teacher_name . ' ';}?>
            		    <?php }else{?>
            		    	<?php echo '没有数据';?>
            		    <?php }?>
            		    
            		</li>
            		<li>上课地点：
            		<?php foreach ( $actualClass['timesite'] as $timeSite){ ?>
            			<span 
            			    <?php if($timeSite['conflict']){?>
            				class="time-site-conflict"  title="
                			    <?php foreach ($timeSite['conflict'] as $c){?>
                			    <?php echo $c['class_name'].$c['time'].'&nbsp;&nbsp;';?>
                			    <?php }?>"
            			    <?php }else{?>
            			    		class="time-site"
            			    <?php }?>
            			    >
                			星期<?php echo $timeSite['day_of_week'];?>
                			第<?php echo $timeSite['begin_time'];?>到第<?php echo $timeSite['end_time'];?>节课
            			</span>
            		<?php }?>
            		</li>
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
    			<span class="fancybox" cid="<?php echo $courseId;?>">我要推荐</span>
    		</span>
    	</div>
    	<?php foreach ($booksList as $book){?>
    	<div class="book-info">
    		 <div class="book-cover">
    			<img src="<?php echo $book['cover_path'];?>" >
    		 </div>
    		 <div class="book-detail">
        		 <div class="book-title"><span  bookid="<?php echo $book['book_id'];?>" cbid="<?php echo $book['cb_id'];?>" class="up">&nbsp;&nbsp;</span><span  bookid="<?php echo $book['book_id'];?>" cbid="<?php echo $book['cb_id'];?>" class="down">&nbsp;&nbsp;</span><?php echo $book['book_name'];?></div>
        		 <div>作者: <?php echo $book['provider_name'];?></div>
        		 <div>推荐者: <?php echo $book['provider_name'];?></div>
        		 <div>
        		 <?php if(!$book['comment']){?>
        		 第一推荐人没有评论此书<br/>
        		 <?php }else{?>
        		 <?php echo $book['comment'];?>
        		 <?php }?>
        		 </div>
        	</div>
        	<div class="clear_float"></div>
    	</div>
    	<?php }?>
	</div>
	<div class="clear_float"></div>
</div>
