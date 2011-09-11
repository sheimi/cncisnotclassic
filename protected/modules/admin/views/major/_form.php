<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'major-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'dep_id'); ?></div>
		<?php echo $form->textField($model,'dep_id',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'dep_id'); ?>
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