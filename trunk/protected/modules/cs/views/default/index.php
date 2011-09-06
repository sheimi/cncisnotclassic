<div id="content-left">
    <?php //echo $this->renderPartial('../search-box', array('model'=>$model)); ?>
    <script type="text/javascript">
    	$(function(){
        	var promptStr = '搜索课本、院系课程、教师';
			$('#keyword').bind('focus', function(){
				if(promptStr == $(this).val()){
    				$(this).val("");
    				$(this).addClass('activeinput');
				}
			});
			$('#keyword').bind('blur', function(){
				if( '' == $(this).val()){
					$(this).val(promptStr);
					$(this).removeClass('activeinput');
				}
			})
        });
    </script>
    <div class="search-box">
    	<form>
    		<input type="hidden" name='r' value="cs/search/all" />
        	<input id="keyword" name='q' type="text" value="搜索课本、院系课程、教师">
        	<input type="submit" value="搜索" />
    	</form>
    </div>
    <div id="hot-book">
    	<div class="header"><h1>热门书籍</h1></div>
    	<?php if($hotbookList){foreach ($hotbookList as $item){?>
    	<div class="book-item">
    		<a href="<?php echo Yii::app()->request->baseUrl . '/index.php?r=cs/books/viewbook&bid=' . $item['book']['book_id'];?>">
    			<img class="book_cover" alt="<?php echo $item['book']['book_name'];?>" src="<?php echo  $item['book']['cover_path'];?>" >
    		</a>
    		<div class="name">
    		     <?php echo $item['book']['book_name'];?>
    		    <a href="<?php echo Yii::app()->request->baseUrl . '/index.php?r=cs/course/view&cid=' . $item['course']['course_id']?>">
    		       <span style="color:#FF3D2E;">(<?php echo $item['course']['course_name'];?>)</span>
    			</a>
    		</div>
    	</div>
    	
    	<!-- 每六本书加个clear_float -->
    	<?php if($i++ == 5){?>
    	<div class="clear_float"></div>
    	<?php }?>
    	<?php }
    	}?>
    	<div class="clear_float"></div>
    </div>
    
    <div id="hot-book">
    	<div class="header"><h1>最新关联书籍</h1></div>
    	<?php if($hotbookList){foreach ($hotbookList as $item){?>
    	<div class="book-item">
    		<a href="<?php echo Yii::app()->request->baseUrl . '/index.php?r=cs/books/viewbook&bid=' . $item['book']['book_id'];?>">
    			<img class="book_cover" alt="<?php echo $item['book']['book_name'];?>" src="<?php echo  $item['book']['cover_path'];?>" >
    		</a>
    		<div class="name">
    		     <?php echo $item['book']['book_name'];?>
    		    <a href="<?php echo Yii::app()->request->baseUrl . '/index.php?r=cs/course/view&cid=' . $item['course']['course_id']?>">
    		       <span style="color:#FF3D2E;">(<?php echo $item['course']['course_name'];?>)</span>
    			</a>
    		</div>
    	</div>
    	
    	<!-- 每六本书加个clear_float -->
    	<?php if($i++ == 5){?>
    	<div class="clear_float"></div>
    	<?php }?>
    	<?php }
    	}?>
    	<div class="clear_float"></div>
    </div>
</div>
<div id="content-right">
	<div class="side-box">
		<div class="title">你将要进行的活动</div>
		dsafds<br>
		dsafds<br>
		dsafds<br>
		dsafds<br>
		dsafds<br>
	</div>	
	<div class="side-box">
		<div class="title">你关注课程的动态</div>
		dsafds<br>
		dsafds<br>
		dsafds<br>
		dsafds<br>
		dsafds<br>
	</div>
	<div class="side-box">
		<div class="title">我们的十大</div>
		百合十大1<br>
		百合十大1<br>
		百合十大1<br>
		百合十大1<br>
		百合十大1<br>
	</div>
</div>
