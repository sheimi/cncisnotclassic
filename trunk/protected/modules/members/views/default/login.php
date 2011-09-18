<div id="content">
<div id="login">
    <div class="form">
    	<h1><?php echo CHtml::encode(Yii::app()->name); ?>登录</h1>
        <?php $form=$this->beginWidget('CActiveForm', array(
        	'id'=>'login-form-login-form',
        	'enableAjaxValidation'=>false,
        )); ?>
        <div class="row">
	    	<?php echo $form->errorSummary($model); ?>
        </div>
    
    	<div class="row">
    		<?php echo $form->labelEx($model,'用户名'); ?>
    		<?php echo $form->textField($model,'username'); ?>
    	</div>
    
    	<div class="row">
    		<?php echo $form->labelEx($model,'密码'); ?>
    		<?php echo $form->passwordField($model,'password'); ?>
    	</div>
    
    	<div class="row">
        		<?php echo CHtml::submitButton('登录', array('class'=>'cnc-button', 'id'=>'loginbtn')); ?>
    	</div>
    	
    	<div class="row remember">
    		<?php echo $form->labelEx($model,'记住密码'); ?>
    		<?php echo $form->checkBox($model,'rememberMe'); ?>
        	<a href="<?php echo Yii::app()->request->baseUrl . '/index.php?r=members/default/register'?>">注册新用户</a>
    	</div>
    	
    
        <?php $this->endWidget(); ?>
    </div>
    
    <!-- form -->
    
</div>
<div class="notice" style="float:left;">
	&nbsp;
</div>
</div>