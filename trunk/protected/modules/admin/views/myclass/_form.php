<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'myclass-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'class_name'); ?></div>
		<?php echo $form->textField($model,'class_name',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'class_name'); ?>
	</div>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'day'); ?></div>
		<?php echo $form->textField($model,'day'); ?>
		<?php echo $form->error($model,'day'); ?>
	</div>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'classroom'); ?></div>
		<?php echo $form->textField($model,'classroom',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'classroom'); ?>
	</div>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'week_info'); ?></div>
		<?php echo $form->textField($model,'week_info',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'week_info'); ?>
	</div>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'member_id'); ?></div>
		<?php echo $form->textField($model,'member_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'member_id'); ?>
	</div>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'actualclass_id'); ?></div>
		<?php echo $form->textField($model,'actualclass_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'actualclass_id'); ?>
	</div>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'time'); ?></div>
		<?php echo $form->textField($model,'time'); ?>
		<?php echo $form->error($model,'time'); ?>
	</div>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'custom'); ?>
		<?php echo $form->textField($model,'custom',array('size'=>60,'maxlength'=>255)); ?></div>
		<?php echo $form->error($model,'custom'); ?>
	</div>

	<div class="row buttons">
		<div class="form-label"><?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->