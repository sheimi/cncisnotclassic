<?php
$this->breadcrumbs=array(
	'Myclasses'=>array('index'),
	$model->myclass_id,
);

$this->menu=array(
	array('label'=>'List Myclass', 'url'=>array('index')),
	array('label'=>'Create Myclass', 'url'=>array('create')),
	array('label'=>'Update Myclass', 'url'=>array('update', 'id'=>$model->myclass_id)),
	array('label'=>'Delete Myclass', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->myclass_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Myclass', 'url'=>array('admin')),
);
?>

<h1>View Myclass #<?php echo $model->myclass_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'myclass_id',
		'class_name',
		'day',
		'classroom',
		'week_info',
		'member_id',
		'actualclass_id',
		'time',
		'custom',
	),
)); ?>
