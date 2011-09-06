<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui-1.8.11.custom.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/cs.css" />
	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/autocomplete.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/autocomplete/jquery.autocomplete.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/autocomplete/lib/thickbox.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox-1.3.4.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/jrating_v2.1/jquery/jRating.jquery.css" />
	
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery-1.5.1.js');?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/ui/jquery-ui-1.8.11.custom.js');?>
	
	<!-- 弹出窗口 -->
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/jquery.fancybox-1.3.4.js');?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/jquery.easing-1.3.pack.js');?>
	
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/autocomplete/lib/jquery.bgiframe.min.js');?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/autocomplete/lib/jquery.ajaxQueue.js');?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/autocomplete/lib/thickbox-compressed.js');?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/autocomplete/jquery.autocomplete.js');?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/localdata.js');?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.cookie.js');?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jrating_v2.1/jquery/jRating.jquery.js');?>

	<script type="text/javascript">
    <!--
   		var BASE_URL = "<?php echo Yii::app()->request->baseUrl;?>";
    //-->
    </script>
	<style type="text/css">
		.clear_float{
			width:100%;
			clear:both;
		}
	</style>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">
	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'首页', 'url'=>array('/default/default')),
				array('label'=>'个人中心', 'url'=>array('/members/profile')),
				array('label'=>'关于我们', 'url'=>array('/default/site/about')),
				//array('label'=>'联系我们', 'url'=>array('/default/site/contactus')),
				array('label'=>'项目反馈', 'url'=>array('/default/site/feedback')),
				array('label'=>'Login', 'url'=>array('/members/default/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/members/default/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->

	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
	)); ?><!-- breadcrumbs -->

	<?php echo $content; ?>

	<div class="clear_float"></div>
	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by <a>LilyStudio</a>.<br/>
		All Rights Reserved.<br/>
		<?php echo 'LilyStudio'; ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>