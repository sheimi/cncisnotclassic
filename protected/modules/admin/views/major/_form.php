<?php
	$rows = Departments::model()->findAllBySql('select dep_id, dep_name from departments');
		
	$depList = array();
	foreach($rows as $row){
	  $dep = array();
		$dep['dep_id'] = $row->dep_id;
		$dep['dep_name'] = $row->dep_name;
		$depList[] = $dep;
	}
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'major-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="form-label"><label for="Major_dep_id" class="required">Dep <span class="required">*</span></label></div>
		<select id="Major_dep_id" name="Major[dep_id]">
			<?php if ($model->isNewRecord) {?>
			<option value="-1">请选择</option>
			<?php } ?>
    		<?php
				foreach($depList as $dep) {?>
    			<option value="<?php echo $dep['dep_id'];?>"
					<?php if(!$model->isNewRecord && $model->dep->dep_name == $dep['dep_name']) echo 'selected="selected"';?>>
					<?php echo $dep['dep_name'];?></option>
    		<?php }?>
    </select>
	</div>
	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'major_name'); ?></div>
		<?php echo $form->textField($model,'major_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'major_name'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->