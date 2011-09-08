<?php
$this->breadcrumbs=array(
	'Campuses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Campus', 'url'=>array('index')),
	array('label'=>'Manage Campus', 'url'=>array('admin')),
);
?>

<h1>Create Campus</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>