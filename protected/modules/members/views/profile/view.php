<div id="viewprofile">
	<div id="baseinfo">
    	<div class="box-title"><?php echo Yii::app()->user->getState('username');?>j基本资料</div>
		<div class="content-box">
    		<div>
    			<span>百合帐号：</span>
    			<span><?php echo $userInfo['bbs_name']; ?></span>
    		</div>
    		
    		<div>
    			<span>本站帐号：</span>
    			<span><?php echo $userInfo['username']; ?></span>
    		</div>
    		
    		<div>
    			<span>所在院系：</span>
    			<span><?php echo $userInfo['major']; ?></span>
    		</div>
    		
    		<div>
    			<span>邮箱：</span>
    			<span><?php echo $userInfo['email']; ?></span>
    		</div>
		</div>
	</div>
	
    <!-- 他推荐的书 -->
    <div id="ownbook">
    	<div class="box-title"><?php echo Yii::app()->user->getState('username');?>推荐过的书</div>
    	<div class="content-box">
        	<?php foreach ($recommendBookList as $book){?>
        		<div class="book">
        			<img title="<?php echo $book['book_name'];?>" src="<?php echo $book['image'];?>">
        			<div  title="<?php echo $book['book_name'];?>" ><a href=""><?php echo $book['book_name'];?></a></div>
        		</div>
        	<?php }?>
        	<div class="clear_float"></div>
        </div>
    </div>
     <!-- 他推荐的书 -->
     
    <div id="ownbook">
    	<div class="box-title"><?php echo Yii::app()->user->getState('username');?>的书架</div>
        <div class="content-box">
        	<?php foreach ($ownBookList as $book){?>
        		<div class="book">
        			<img title="<?php echo $book['book_name'];?>" src="<?php echo $book['image'];?>">
        			<div  title="<?php echo $book['book_name'];?>" ><a href=""><?php echo $book['book_name'];?></a></div>
        		</div>
        	<?php }?>
        	<div class="clear_float"></div>
        </div>
    </div>
    <!-- 他推荐的书 -->
     
    <div class="clear_float"></div>
    <div id="likecourse">
    	<div class="box-title"><?php echo Yii::app()->user->getState('username');?>他评价过的课程</div>
    	<div class="content-box">
        	<?php foreach ($likeCourseList as $course){?>
        		<div>
            		<span><a href="<?php echo Yii::app()->request->baseUrl . '/index.php?r=cs/course/view&cid=' . $course['course_id'];?>"><?php echo $course['course_name']; ?></a></span>
            		<span>(<?php echo $course['star']; ?>分)</span>
        		</div>
        	<?php }?>
        </div>
    </div>
    
    <!-- 用户的课表 -->
    <div id="myclass">
    	<div class="box-title"><?php echo Yii::app()->user->getState('username');?>的课程表</div>
    	<div class="">
    		<?php if (is_array($myclass)){?>
    			<!-- 根据取出的课程数据，生成一张课表 -->
    			<table>
    				<tr>
    					<th style="border:1px solid #ddd;  height:36px;padding:0px;">选项</th>
    					<th style="border:1px solid #ddd;  height:36px;padding:0px;">星期一</th>
    					<th style="border:1px solid #ddd;  height:36px;padding:0px;">星期二</th>
    					<th style="border:1px solid #ddd;  height:36px;padding:0px;">星期三</th>
    					<th style="border:1px solid #ddd;  height:36px;padding:0px;">星期四</th>
    					<th style="border:1px solid #ddd;  height:36px;padding:0px;">星期五</th>
    					<th style="border:1px solid #ddd;  height:36px;padding:0px;">星期六</th>
    					<th style="border:1px solid #ddd;  height:36px;padding:0px;">星期天</th>
    				</tr>
    				<?php $i = 1; for($outer = 0; $outer < 10; $outer++){?>
    					<tr>
    						<td style="border:1px solid #ddd;  height:36px;padding:0px;"><?php echo '第' . $i++ . '节';?></td>
    						<?php for($week = 0; $week < 7; $week++){?>
    							<td id="<?php echo $myclass[$outer * 7 + $week]['myclass_id'];?>" class="edit"  style="border:1px solid #ddd;  height:36px;padding:0px;">
    							<?php if(!$myclass[$outer * 7 + $week]['custom']){?>
        						    <?php echo $myclass[$outer * 7 + $week]['class_name'].' '; ?>
        						    <?php //echo $myclass[$outer * 7 + $week]['classroom']; ?>
        						<?php }else{?>
        							<?php echo $myclass[$outer * 7 + $week]['custom']; ?>
        						<?php }?>
    							</td>
    						<?php }?>
    					</tr>
    				<?php }?>
    			</table>
    		<?php }else{?>
    			<p>你还未初始化你的课表，初始化之后可以自定义课表，建议你  <a>初始化</a></p>
    		<?php }?>
        </div>
    </div>
    
</div>