<?php

		Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/assets/c8c9f704/jquery.js');
		$rows = Departments::model()->findAllBySql('select dep_id, dep_name from departments');
		
		$depList = array();
		foreach($rows as $row){
		    $dep = array();
		    $dep['dep_id'] = $row->dep_id;
		    $dep['dep_name'] = $row->dep_name;
		    $depList[] = $dep;
		}
		if (!$model->isNewRecord) {
			$rows = Major::model()->findAllBySql('select major_id, major_name from major where dep_id='.$model->major->dep_id);
			$majorList = array();
			foreach($rows as $row){
		    $major = array();
		    $major['major_id'] = $row->major_id;
		    $major['major_name'] = $row->major_name;
		    $majorList[] = $major;
			}
		}
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'bbs_name'); ?></div>
		<?php echo $form->textField($model,'bbs_name',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'bbs_name'); ?>
	</div>
	
	<div class="row">
		<div class="form-label"><label for="Users_major_id" class="required">Major <span class="required">*</span></label></div>
		<select id="deps" name="dep">
			<?php if ($model->isNewRecord) {?>
			<option value="-1">请选择</option>
			<?php } ?>
    		<?php
				foreach($depList as $dep) {?>
    			<option value="<?php echo $dep['dep_id'];?>"
					<?php if(!$model->isNewRecord && $model->major->dep->dep_name == $dep['dep_name']) echo 'selected="selected"';?>>
					<?php echo $dep['dep_name'];?></option>
    		<?php }?>
    </select>
		<select name="Users[major_id]" id="Users_major_id">
			<?php if ($model->isNewRecord) {?>
				<option value='-1'>请选择</option>
			<?php } else {
				foreach($majorList as $major) { ?>
    		<option value="<?php echo $major['major_id'];?>"
				<?php if($model->major->major_name == $major['major_name']) echo 'selected="selected"';?>>
				<?php echo $major['major_name'];?></option>
			<?php }} ?>
    </select>
	</div>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'email'); ?></div>
		<?php echo $form->textField($model,'email',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'grade'); ?></div>
		<?php echo $form->textField($model,'grade',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'grade'); ?>
	</div>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'njuid'); ?></div>
		<?php echo $form->textField($model,'njuid',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'njuid'); ?>
	</div>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'real_name'); ?></div>
		<?php echo $form->textField($model,'real_name',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'real_name'); ?>
	</div>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'username'); ?></div>
		<?php echo $form->textField($model,'username',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'password'); ?></div>
		<?php echo $form->passwordField($model,'password',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'avatar_path'); ?></div>
		<?php echo $form->textField($model,'avatar_path',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'avatar_path'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
$(document).ready(function() {
	$('#deps').change(function(event){
		var selectedVal = $('#deps').val();

		if(selectedVal != -1) {
			$.ajax({
				url:'index.php?r=members/default/getmajor',
				data:{
					dep_id:selectedVal
				},
				success:function(data, status){
					var majorList = $.parseJSON(data);
					$('#Users_major_id').html('');
				  $('#Users_major_id').append('<option>请选择</option>');
					for (i in majorList){
						$('#Users_major_id').append('<option  value="' + majorList[i]['id'] + '">' + majorList[i]['name'] + '</option>');
					}
				}
			});
		}
	});
});
</script>