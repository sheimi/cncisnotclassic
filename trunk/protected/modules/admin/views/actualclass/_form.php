<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'actualclass-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'course_id'); ?></div>s
		<?php echo $form->textField($model,'course_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'course_id'); ?>
	</div>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'term'); ?></div>
		<?php echo $form->textField($model,'term',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'term'); ?>
	</div>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'grade'); ?></div>
		<?php echo $form->textField($model,'grade',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'grade'); ?>
	</div>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'credit'); ?></div>
		<?php echo $form->textField($model,'credit'); ?>
		<?php echo $form->error($model,'credit'); ?>
	</div>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'period'); ?></div>
		<?php echo $form->textField($model,'period'); ?>
		<?php echo $form->error($model,'period'); ?>
	</div>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'course_type'); ?></div>
		<?php echo $form->textField($model,'course_type',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'course_type'); ?>
	</div>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'major_id'); ?></div>
		<?php echo $form->textField($model,'major_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'major_id'); ?>
	</div>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'site'); ?></div>
		<?php echo $form->textArea($model,'site',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'site'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->