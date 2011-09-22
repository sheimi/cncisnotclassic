<div id="register-content">
    <h1>注册新用户</h1>
    <script type="text/javascript">
    	var validEmail, validUsername, validMajor;
    	function verifyAddress(email)  
　　　　　{  
   　　　　　　var pattern = /^[a-zA-Z]([a-zA-Z0-9]*[-_.]?[a-zA-Z0-9]+)+@([\w-]+\.)+[a-zA-Z]{2,}$/;  
   　　　　　　flag = pattern.test(email);  
   　　　　　　if(flag)  
   　　　　　　{  
   　　　　　　	return true;  
   　　　　　　}  else {  
   　　　　　　　　return false;  
   　　　　　　}  
　　　　　 }  
		$(function(){
			$('#email').blur( function(){
				if($('#email').val() != '' && !verifyAddress( $('#email').val() + "@smail.nju.edu.cn"))
				{
					$('#emailErr').html('邮箱格式不对');
					return false;
				}
    			$.ajax({
					url:'index.php?r=members/default/checkemail',
					data:{
						email:$('#email').val()
					},
					success:function(data, status){
						if(data == 'true'){
							$('#emailErr').html('');
							validEmail = true;
						}else{
							$('#emailErr').html('该email已经注册过<a href="index.php?r=members/default/resendpwd&email='+$('#email').val()+'">重新发送邮件修改密码</>');
							validEmail = false;
						}
					}
        		});
            });

			$('#username').blur( function(){
    			$.ajax({
					url:'index.php?r=members/default/checkusername',
					data:{
						username:$('#username').val()
					},
					success:function(data, status){
						if(data == 'true'){
							$('#usernameErr').html('');
							validUsername = true;
						}else{
							$('#usernameErr').html("该用户名已经有人使用，换一个再试吧");
							validUsername = false;
						}
					}
        		});
            });

            $('#deps').change(function(event){
				var selectedVal = $('#deps').val();

				if(selectedVal != -1)
				{
					$.ajax({
						url:'index.php?r=members/default/getmajor',
						data:{
							dep_id:selectedVal
						},
						success:function(data, status){
							var majorList = $.parseJSON(data);
							$('#majors').html('');
							$('#majors').append('<option value="-1">请选择</option>');
							for (i in majorList){
								$('#majors').append('<option  value="' + majorList[i]['id'] + '">' + majorList[i]['name'] + '</option>');
							}
						}
					});
				}
			});

			$('#majors').change(function(event){
			});


			$('#registerSubmit').click(function(){
				if($('#email').val() == '' || $('#email').val() == null)
				{
					$('#emailErr').html('学校邮箱不能为空');
					return false;
				}

				if(!verifyAddress( $('#email').val() + "@smail.nju.edu.cn"))
				{
					$('#emailErr').html('邮箱格式不对');
					return false;
				}
				if($('#username').val() == '' || $('#username').val() == null){
					$('#emailErr').html('用户名不能为空');
					return false;
				}

				if($('#majors').val() == -1){
					$('#majorError').html('请选择专业');
					return false;
				}

				return true;
			});
		});
    </script>
    <form action="index.php?r=members/default/newuser" method="post">
    <ul class="reg_list">
    	<li class="email">
    		<label class="lf">学校邮箱：</label> 
    		<input id="email" name="email" type="text" class="text"
    		value="">@smail.nju.edu.cn &nbsp;&nbsp;<span id="emailErr" class="worry_tis"></span></li>
    	<li style="color:#aaa; ">
    	@smail.nju.edu.cn的邮箱为南京大学邮箱，帐户名为b加上学号，密码默认为身份证号。
    	<a href="http://smail.nju.edu.cn" target="_blank">南大邮箱直通车</a></li>
    	<li class="username"><label class="lf">用户名：</label>
    		<input id="username" name="username" type="text" maxlength="32"
    		class="text" value=""> <span id="usernameRule" class="tis">请输入1-20位数字、字母</span>
    		 &nbsp;&nbsp;&nbsp;&nbsp;<span id="usernameErr" class="worry_tis"></span>
    	</li>
    	
    	<li class="grade">
    		<label class="lf">入学时间：</label>
			<select name="grade">
				<?php for ($year = 2007; $year <= date('Y'); $year++){?>
				<option value="<?php echo $year;?>"><?php echo $year;?></option>
				<?php }?>
			</select>
		</li>
    		
    	<li class="major">
    		<label class="lf">专&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;业：</label> 
			<select id="deps" name="dep">
			<option value="-1">请选择</option>
    		<?php foreach($depList as $dep){?>
    			<option value="<?php echo $dep['dep_id'];?>"><?php echo $dep['dep_name'];?></option>
    		<?php }?>
    		
    		</select>
    		<select id="majors" name="major">
    			<option value='-1'>请选择</option>
    		</select>
    		<span id="majorError" class="worry_tis"></span>
    	</li>
    	<li class="btn">
    		<input id="registerSubmit" name="registerSubmit" type="submit"
    			value="发送注册邮件" class="reg_btn cnc-button">
    	</li>
    </ul>
    </form>
</div>