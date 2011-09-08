<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'books-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'book_name'); ?>
		<?php echo $form->textField($model,'book_name',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'book_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isbn'); ?>
		<?php echo $form->textField($model,'isbn',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'isbn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'provider'); ?>
		<?php echo $form->textField($model,'provider',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'provider'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cover_path'); ?>
		<?php echo $form->textField($model,'cover_path',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'cover_path'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'add_time'); ?>
		<?php echo $form->textField($model,'add_time'); ?>
		<?php echo $form->error($model,'add_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'author'); ?>
		<?php echo $form->textField($model,'author',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'author'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'publisher'); ?>
		<?php echo $form->textField($model,'publisher',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'publisher'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textField($model,'comment',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pubdate'); ?>
		<?php echo $form->textField($model,'pubdate'); ?>
		<?php echo $form->error($model,'pubdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->