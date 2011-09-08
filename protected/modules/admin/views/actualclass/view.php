<?php
$this->breadcrumbs=array(
	'Actualclasses'=>array('index'),
	$model->class_id,
);

$this->menu=array(
	array('label'=>'List Actualclass', 'url'=>array('index')),
	array('label'=>'Create Actualclass', 'url'=>array('create')),
	array('label'=>'Update Actualclass', 'url'=>array('update', 'id'=>$model->class_id)),
	array('label'=>'Delete Actualclass', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->class_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Actualclass', 'url'=>array('admin')),
);
?>

<h1>View Actualclass #<?php echo $model->class_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'class_id',
		'course_id',
		'term',
		'grade',
		'credit',
		'period',
		'course_type',
		'major_id',
		'site',
	),
)); ?>
