<div id="content-left">
    <h1>注册新用户</h1>
    <ul class="reg_list">
    	<li class="lg_email"><span class="lf">学校邮箱：</span> <input
    		id="userAcount" name="user.userAcount" type="text" class="text"
    		value="">@smail.nju.edu.cn</li>
    	<li id="userAcountErr" class="worry_tis"></li>
    	<li class="lg_name"><span class="lf">昵&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;称：</span>
    	<input id="nick" name="user.nick" type="text" maxlength="32"
    		class="text" value=""> <span id="nickRule" class="tis">请输入1-20位数字、字母和中文</span>
    	</li>
    	<li id="nickErr" class="worry_tis"></li>
    	<li class="lg_possword"><span class="lf">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码：</span>
    	<input id="password" name="user.password" type="password" class="text"
    		maxlength="18"> <span id="passwordRule" class="tis">限6-18位字符</span></li>
    	<li id="passwordErr" class="worry_tis"></li>
    	<li class="lg_confirm"><span class="lf">确认密码：</span> <input
    		id="password1" name="password1" type="password" class="text"
    		maxlength="18"></li>
    		
    	<li id="grade" class="worry_tis"></li>
    	<li class="lg_confirm"><span class="lf">年&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;级：</span> <input
    		id="password1" name="password1" type="password" class="text"
    		maxlength="18"></li>
    		
    	<li id="passwordErr" class="worry_tis"></li>
    	<li class="major"><span class="lf">专&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;业：</span> 
    		<select id="Users_major_id" name="Users[major_id]">
    		<?php foreach($depList as $dep){?>
    		<option value="251"><?php echo $dep['dep_name'];?></option>
    		<?php }?>
    		</select>
    		<select></select>
    		<?php echo $form->error($model,'major_id'); ?>
    	</li>
    	<li id="password1Err" class="worry_tis"></li>
    	<li class="lg_btn">
    	<dl>
    		<dd><input id="registerSubmit" name="registerSubmit" type="button"
    			value="入驻CNC" class="reg_btn"></dd>
    	</dl>
    	</li>
    </ul>
</div>