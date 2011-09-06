<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'book-info',
	'enableAjaxValidation'=>true,
)); ?>

	<?php echo $form->errorSummary($model); ?>
	<div class="input-item" id="book-cover">
		<img name="book_cover" style="float:left;" src="<?php echo Yii::app()->request->baseUrl;?>/images/100.png" width="100" height="100">
    	<div class="clear_float"></div>
		<?php echo $form->fileField($model,'cover_path'); ?>
		<?php echo $form->error($model,'cover_path'); ?>
	</div>
	<div id="book-detail"> 
    	<div class="input-item">
    		<?php echo $form->labelEx($model,'book_name'); ?>
    		<?php echo $form->textField($model,'book_name'); ?>
    		<?php echo $form->error($model,'book_name'); ?>
    	</div>
    
    	<div class="input-item">
    		<?php echo $form->labelEx($model,'isbn'); ?>
    		<?php echo $form->textField($model,'isbn'); ?>
    		<?php echo $form->error($model,'isbn'); ?>
    	</div>
    
    	<div class="input-item">
    		<?php echo $form->labelEx($model,'author'); ?>
    		<?php echo $form->textField($model,'author'); ?>
    		<?php echo $form->error($model,'author'); ?>
    	</div>
    
    	<div class="input-item">
    		<?php echo $form->labelEx($model,'publisher'); ?>
    		<?php echo $form->textField($model,'publisher'); ?>
    		<?php echo $form->error($model,'publisher'); ?>
    	</div>
    	<input name="access" type="radio" value="borrow" checked="true">我有可借&nbsp;&nbsp;
    	<input name="access" type="radio" value="sell">我有可卖&nbsp;&nbsp;
    	<input name="access" type="radio" value="private">我在用&nbsp;&nbsp;
		<input name="access" type="radio" value="havent">我没有&nbsp;&nbsp;
	</div>
	<div class="clear_float"></div>
	<div id="first-comment">
		<?php echo $form->labelEx($model,'comment'); ?>
		<div id="content">
    		<?php echo $form->textArea($model,'comment'); ?>
		</div>
		<?php echo $form->error($model,'comment'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->