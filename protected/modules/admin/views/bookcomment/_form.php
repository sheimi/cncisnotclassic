<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bookcomment-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'book_id'); ?></div>
		<?php echo $form->textField($model,'book_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'book_id'); ?>
	</div>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'user_id'); ?></div>
		<?php echo $form->textField($model,'user_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'content'); ?></div>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'add_time'); ?></div>
		<?php echo $form->textField($model,'add_time'); ?>
		<?php echo $form->error($model,'add_time'); ?>
	</div>

	<div class="row">
		<div class="form-label"><?php echo $form->labelEx($model,'star'); ?></div>
		<?php echo $form->textField($model,'star',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'star'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->