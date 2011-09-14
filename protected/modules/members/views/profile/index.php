<script>
	$(function() {
		$( "#profile-tab" ).tabs({
			cookie: {
				// store cookie for a day, without, it would be a session cookie
				expires: 1
			}
		});
	});
</script>

<div id="profileindex">
	<div id="profile-tab">
    	<ul>
    		<li><a href="#tabs-2">个人资料</a></li>
    		<li><a href="#tabs-3">我的书籍</a></li>
    		<!-- <li><a href="#tabs-4">保密设置</a></li> -->
    	</ul>
    	
    	
    	<div id="tabs-2" class="tab">
    		<div class="tab-content">
        		<div class="box-title">个人资料</div>
        		<div class="content-box">
        			<table>
        				<tr>
        					<td>用户名</td>
        					<td><?php echo $userInfo['username'];?></td>
        				</tr>
        				<tr>
        					<td>专业</td>
        					<td><?php echo $userInfo['major'];?></td>
        				</tr>
        				<tr>
        					<td>邮箱</td>
        					<td><?php echo $userInfo['email'];?>@smail.nju.edu.cn</td>
        				</tr>
        			</table>
        		</div>
    		</div>
    	</div>
    	<div id="tabs-3" class="tab">
    		<div class="tab-content">
        		<div class="box-title">我推荐的书籍&nbsp;&nbsp;<span><a href="index.php?r=members/profile/recommendbooks">查看全部&gt;&gt;</a></span></div>
        		<div class="content-box">
        			<?php foreach ($recommendBookList as $book){?>
        				<div class="book">
        					<a href="<?php echo Yii::app()->request->baseUrl . '/index.php?r=cs/books/viewbook&bid=' . $book['book_id'];?>">
    						<img src="<?php echo $book['image'];?>">
    						</a>
        					<?php echo $book['book_name']?>
        				</div>
        			<?php }?>
        			<div class="clear_float"></div>
        		</div>
        		
        		<div class="box-title">我有的书&nbsp;&nbsp;<span><a href="index.php?r=members/profile/ownbook">查看全部&gt;&gt;</a></span></div>
        		<div class="content-box">
        			<?php foreach ($ownBookList as $book){?>
        				<div class="book">
        					<a href="<?php echo Yii::app()->request->baseUrl . '/index.php?r=cs/books/viewbook&bid=' . $book['book_id'];?>">
    						<img src="<?php echo $book['image'];?>">
    						</a>
        						<?php echo $book['book_name']?>
        				</div>
        			<?php }?>
        			<div class="clear_float"></div>
        		</div>
        		
        	<div class="clear_float"></div>
        </div>
	</div>
	<div  style="display: none; ">
    	<div id="edit_event">
            <p><label>课程名称:</label><input id="event_title" type="text" name="event_title"></p>
            <p><label>地点:</label><input id="event_place" type="text" name="event_place"></p>
            <input type="submit" id="cell_submit">
    	</div>
	</div>
</div>