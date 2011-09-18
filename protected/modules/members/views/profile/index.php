<script>
function check_changepswfield(){
	if($("#oldpsw").val() == ""){
		alert("原密码不能为空");
		return false;
	}

	if($("#newpsw").val() == ""){
		alert("新密码不能为空");
		return false;
	}

	if($("#newconfirm").val() == ""){
		alert("新密码确认不能为空");
		return false;
	}

	if($("#newconfirm").val() != $("#newconfirm").val()){
		alert("两次输入新密码不相同");
		return false;
	}

	return true;
}
	$(function() {
		$( "#profile-tab" ).tabs({
			cookie: {
				// store cookie for a day, without, it would be a session cookie
				expires: 1
			}
		});

		$(".changepsw").bind('click', function(){
			$.ajax({
				url:"<?php echo BU . 'members/profile/changepswform';?>",
				success:function(data, status){
        			$("#changepswfield").empty();
        			$("#changepswfield").html(data);
        			$("#changepswfield").fadeIn();
        			$(".changepsw").val("保存新密码");
        			$(".changepsw").addClass("savepsw");
        			$(".changepsw").removeClass("changepsw");
				}
			});
		});

		$(".savepsw").live('click', function(){
			if(check_changepswfield()){
    			$.ajax({
    				url:"<?php echo BU . 'members/profile/savenewpsw';?>",
    				type:'post',
    				data:{
    					oldpsw:$("#oldpsw").val(),
    					newpsw:$("#newpsw").val(),
    					newconfirm:$("#newconfirm").val()
    				},
    				success:function(data, status){
    	        		$().toastmessage('showToast', {
    	        		    text     : data,
    	        		    sticky   : false,
    	        		    position : 'top-center',
    	        		    type     : 'success',
    	        		    stayTime: 500
    	        		});
    	        		
    					if('修改密码成功'){
    						$("#changepswfield").fadeOut();
    						$("#changepswfield").empty();
    					}
    					$(".savepsw").val("修改密码");
    					$(".savepsw").addClass("changepsw");
            			$(".savepsw").removeClass("savepsw");
    				}
    			});
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
    				<div>
    					<input class="changepsw cnc-button" type="button" value="修改密码">
    					<div id="changepswfield">
    					
    					</div>
    				</div>
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
        					<a href="<?php echo BU . 'cs/books/viewbook&bid=' . $book['book_id'];?>">
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
</div>