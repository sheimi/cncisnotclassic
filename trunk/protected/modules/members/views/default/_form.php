<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'bbs_name'); ?>
		<?php echo $form->textField($model,'bbs_name',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'bbs_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'major_id'); ?>
		<?php echo $form->textField($model,'major_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'major_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'grade'); ?>
		<?php echo $form->textField($model,'grade',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'grade'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'njuid'); ?>
		<?php echo $form->textField($model,'njuid',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'njuid'); ?>
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