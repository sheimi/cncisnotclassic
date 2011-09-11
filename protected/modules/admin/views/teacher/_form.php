<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'teacher-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'teacher_name'); ?></div>
		<?php echo $form->textField($model,'teacher_name',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'teacher_name'); ?>
	</div>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'sex'); ?></div>
		<?php echo $form->textField($model,'sex'); ?>
		<?php echo $form->error($model,'sex'); ?>
	</div>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'introduction'); ?></div>
		<?php echo $form->textArea($model,'introduction',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'introduction'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->