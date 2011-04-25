<div>目前只支持南京大学同学使用此系统</div>
<div style="width:60%;float:left;" class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
    	'id'=>'login-form-login-form',
    	'enableAjaxValidation'=>false,
    )); ?>
    
    	<p class="note">Fields with <span class="required">*</span> are required.</p>
    
    	<?php echo $form->errorSummary($model); ?>
    
    	<div class="row">
    		<?php echo $form->labelEx($model,'username'); ?>
    		<?php echo $form->textField($model,'username'); ?>
    		<?php echo $form->error($model,'username'); ?>
    	</div>
    
    	<div class="row">
    		<?php echo $form->labelEx($model,'password'); ?>
    		<?php echo $form->textField($model,'password'); ?>
    		<?php echo $form->error($model,'password'); ?>
    	</div>
    
    	<div class="row">
    		<?php echo $form->labelEx($model,'rememberMe'); ?>
    		<?php echo $form->checkBox($model,'rememberMe'); ?>
    		<?php echo $form->error($model,'rememberMe'); ?>
    	</div>
    
    
    	<a href="<?php echo Yii::app()->request->baseUrl . '/index.php?r=members/default/register'?>">注册新用户</a>
    	<div class="row buttons">
    		<?php echo CHtml::submitButton('Submit'); ?>
    	</div>
    
    <?php $this->endWidget(); ?>
</div><!-- form -->

<div style="width:39%;float:right;">
	<div class="side-box">
		<div class="title">系统公告</div>
		dsafdsdsafdsdsafdsdsafdsdsafdsdsafds<br>
		ddsafdsdsafdsdsafdsdsafdssafds<br>
		dsdsafdsdsafdsdsafdsdsafdsdsafdsdsafdsafds<br>
		dsdsafdsdsafdsdsafdsdsafdsafds<br>
		dsdsafdsdsafdsdsafdsdsafdsdsafdsafds<br>
	</div>
</div>