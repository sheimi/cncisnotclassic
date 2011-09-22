 <div id="content-left">
 <!-- <?php echo $this->renderPartial('../search-box', array('model'=>$model)); ?> -->
    <script type="text/javascript">
    	$(function(){
        	var q = '<?php echo $q; ?>';
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
			});
            $('.sresult-type li').live('click', function(){
    			$('.active-sr').removeClass('active-sr');
    			$(this).addClass('active-sr');
    
    			var keyword = q;
    			var queryId = $(this).attr('qid');
    			$.ajax({
    	        	url:"<?php echo BU . "cs/search/query&type="; ?>" + queryId,
    	        	data:"q=" + encodeURIComponent(q),
    				success:function(data, status){
        				$('#result-list').html("").fadeOut('fast');
                		$('#result-list').html(data).fadeIn('slow');
    				}
    	    	});
    		});
        });

    </script>
    <div class="search-box">
    	<form>
    		<input type="hidden" name='r' value="cs/search/all" />
        	<input id="keyword" name='q' type="text" <?php if(isset($q)){?>class="activeinput"<?php }?> value="<?php echo  isset($q)?$q:'搜索课本、课程、教师';?>">
        	<input class="cnc-button" type="submit" value="搜索" />
    	</form>
    </div>
    
    <div id="search-result">
	 	<ul class="sresult-type">
    		<li qid="course" class="active-sr">课程</li>
    		<li qid="teacher">教师</li>
    		<li qid="book">课本</li>
    	</ul>
    	<hr>
    	<div id="result-list">
        	<?php if(sizeof($courseList) != 0)foreach ($courseList as $course) {?>
            <div class="course-detail">
            	<div class="class-name">
                	<a href="index.php?r=cs/course/view&cid=<?php echo $course['course_id'];?>"><?php echo $course['course_name']; ?></a>
            	</div>
            	<div>
            		<div>
            			<div>
            			<?php $i = 0; foreach ($course['major'] as $m){?>
                			<div class="class-brief">
                					<div>
                        			<?php
                        			 echo '开课院系：' . $m->major_name;
                        		    	 $major_id = $m->major_id;
                        			 ?>
                					</div>
                        			 <span>上课教师：</span>
                        			 
                        			 <?php foreach ($course['teachers'][$major_id] as $t){?>
                        			 <?php echo $t->teacher_name;?>
                        			<?php 
                        			 } 
                        			 ?> 
                			</div>
            			<?php } ?>
            			
                		</div>
                		<div class="clear_float"></div>
            		</div>
            	</div>
            </div>
            <?php }else{
			    echo "找不到和您的查询\" $q\"相符的内容或信息。";
			}?>
		</div>
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