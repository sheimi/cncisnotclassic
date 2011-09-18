<div id="content-left">
    <?php //echo $this->renderPartial('../search-box', array('model'=>$model)); ?>
    <script type="text/javascript">
    	$(function(){
        	var promptStr = '搜索课本、课程、教师';
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
        	<input id="keyword" name='q' type="text" value="搜索课本、课程、教师">
        	<input class="cnc-button" type="submit" value="搜索" />
    	</form>
    </div>
    
    <div id="hot-book">
    	<div class="header"><h1>最近推荐过的参考书</h1></div>
    	<?php if($hotbookList){foreach ($hotbookList as $item){?>
    	<div class="book-item" title="推荐给 &nbsp;<?php echo $item['course']['course_name']?>">
    		<a href="<?php echo Yii::app()->request->baseUrl . '/index.php?r=cs/books/viewbook&bid=' . $item['book']['book_id'];?>">
    			<img class="book_cover" alt="<?php echo $item['book']['book_name'];?>" src="<?php echo  $item['book']['cover_path'];?>" >
    		</a>
    		<div class="name" title="<?php echo $item['book']['book_name'];?>">
    		    <a href="<?php echo Yii::app()->request->baseUrl . '/index.php?r=cs/course/view&cid=' . $item['course']['course_id']?>">
    		       <span style=""><?php echo $item['book']['book_name'];?></span>
    			</a>
    		</div>
    	</div>
    	
    	<!-- 每六本书一排 加个clear_float -->
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
		<div class="title">关注度最高的课程</div>
		<ul>
			<?php $i = 1; foreach ($favCourseList as $course){?>
				<?php if($i > 10){?>
				<li class="top20">
				<?php }else{?>
				<li>
				<?php }?>
					<a href="<?php echo Yii::app()->request->baseUrl . '/index.php?r=cs/course/view&cid='. $course['course_id'];?>">
					    <?php echo $course['course_name'];$i++;?>
					</a>
					(<?php echo $course['course_fans'];?>)
				</li>
			<?php }?>
		</ul>
	</div>	
</div>
