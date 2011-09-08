<?php
$this->breadcrumbs=array(
	'Campuses'=>array('index'),
	$model->campus_id=>array('view','id'=>$model->campus_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Campus', 'url'=>array('index')),
	array('label'=>'Create Campus', 'url'=>array('create')),
	array('label'=>'View Campus', 'url'=>array('view', 'id'=>$model->campus_id)),
	array('label'=>'Manage Campus', 'url'=>array('admin')),
);
?>

<h1>Update Campus <?php echo $model->campus_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>