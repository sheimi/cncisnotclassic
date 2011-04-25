<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	

	<!-- 本站用户名 -->
	<div class="row">
		<?php echo $form->labelEx($model,'本站用户名'); ?>
		<?php echo $form->textField($model,'username',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'密码'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>32,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'百合ID'); ?>
		<?php echo $form->textField($model,'bbs_name',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'bbs_name'); ?>
	</div>
	
	<!-- 年级 -->
	<div class="row">
		<?php echo $form->labelEx($model,'年级'); ?>
		<select  id="Users_grade" name="Users[grade]">
		<?php for($i = 0; $i < 5; $i++){?>
			<option <?php if(!$i){echo 'selected="true"';}?> value="<?php echo date('Y') - $i;?>"><?php echo date('Y') - $i;?></option>
		<?php }?>
		</select>
		<?php echo $form->error($model,'grade'); ?>
	</div>

	<!-- 学号 -->
	<div class="row">
		<?php echo $form->labelEx($model,'学号'); ?>
		<?php echo $form->textField($model,'njuid',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'njuid'); ?>
	</div>
	

	<div class="row">
		<?php echo $form->labelEx($model,'专业'); ?>
		<select id="Users_major_id" name="Users[major_id]">
		<?php foreach($depList as $dep){?>
		<option value="251"><?php echo $dep['dep_name'];?></option>
		<?php }?>
		</select>
		<select></select>
		<?php echo $form->error($model,'major_id'); ?>
	</div>
	<script type="text/javascript">
		$("#Users_major_id").change(depChange);
		function depChange(){
			// 删除后面的select
	        $(this).nextAll("select").remove();

		    // ajax请求下级地区
	        var _self = this;
	        
	        var url = '<?php echo Yii::app()->request->baseUrl . '/index.php?r=members/default/getmajor'?>';

	        $.getJSON(url, {'dep_id':this.value}, function(data){
	            if (data.done)
	            {
	                if (data.retval.length > 0)
	                {
	                    $("<select><option>" + lang.select_pls + "</option></select>").change(regionChange).insertAfter(_self);
	                    var data  = data.retval;
	                    for (i = 0; i < data.length; i++)
	                    {
	                        $(_self).next("select").append("<option value='" + data[i].region_id + "'>" + data[i].region_name + "</option>");
	                    }
	                }
	            }
	            else
	            {
	                alert(data.msg);
	            }
	        });
		}
	</script>

	<!-- 常用邮箱 -->
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'real_name'); ?>
		<?php echo $form->textField($model,'real_name',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'real_name'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->