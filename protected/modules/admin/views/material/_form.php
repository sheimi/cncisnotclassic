<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'material-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'material_name'); ?></div>
		<?php echo $form->textField($model,'material_name',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'material_name'); ?>
	</div>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'material_path'); ?>
		<?php echo $form->textField($model,'material_path',array('size'=>60,'maxlength'=>255)); ?></div>
		<?php echo $form->error($model,'material_path'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->