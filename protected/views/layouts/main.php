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

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui-1.8.11.custom.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/cs.css" />
	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/autocomplete.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox-1.3.4.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/toastmessage/resources/css/jquery.toastmessage.css" />
	
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery-1.5.1.js');?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/ui/jquery-ui-1.8.11.custom.js');?>
	
	<!-- 弹出窗口 -->
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/jquery.fancybox-1.3.4.js');?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/fancybox/jquery.easing-1.3.pack.js');?>
	
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/localdata.js');?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.cookie.js');?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/toastmessage/javascript/jquery.toastmessage.js');?>

	<script type="text/javascript">
    <!--
   		var BASE_URL = "<?php echo Yii::app()->request->baseUrl;?>";
    //-->
    </script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<div class="container" id="page">
	<div id="header">
		<div id="logo"><a href="<?php echo Yii::app()->baseUrl;?>"><img  width="240" height="90" src="<?php echo Yii::app()->baseUrl . '/images/logo.png';?>"></img></a></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'首页', 'url'=>array('/cs/default/index')),
				array('label'=>'个人中心', 'url'=>array('/members/profile/index')),
				//array('label'=>'关于我们', 'url'=>array('/default/site/about')),
				array('label'=>'项目反馈', 'url'=>array('/default/site/feedback')),
				array('label'=>'登录', 'url'=>array('/members/default/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'登出 ('.Yii::app()->user->name.')', 'url'=>array('/members/default/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->

	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
	)); ?><!-- breadcrumbs -->

	<?php echo $content; ?>

	<div class="clear_float"></div>
	<div id="footer">
		<div id="footer-body">
			<div id="other-proj">
				<ul>
					<li><a href="http://www.lilystudio.org">小百合工作室主页</a></li>
					<li><a href="http://classic.njuer.us/">工作室@人人 (南百合)</a></li>
					<li><a href="http://classic.njuer.us/">ClassIC</a></li>
					<li><a href="http://lib.lilystudio.org/">手机图书馆</a></li>
					<li><a href="http://blog.njulily.com">百合有聊</a></li>
				</ul>
			</div>
			<div id="copyright">
        		Copyright &copy; <?php echo date('Y'); ?> by <a>LilyStudio</a>. All Rights Reserved.
			</div>
			<div class="clear_float"></div>
			
		</div>
	</div><!-- footer -->

</div>
<!-- page -->

</body>
</html>