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
		<div class="form-label"><?php echo $form->labelEx($model,'major_id'); ?></div>
		<?php echo $form->textField($model,'major_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'major_id'); ?>
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