<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'campus-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'campus_name'); ?>
		<?php echo $form->textField($model,'campus_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'campus_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'college_id'); ?>
		<?php echo $form->textField($model,'college_id',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'college_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->