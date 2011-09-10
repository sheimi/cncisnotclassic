<?php

$this->menu=array(
	array('label'=>'List Campus', 'url'=>array('index')),
	array('label'=>'Create Campus', 'url'=>array('create')),
	array('label'=>'Update Campus', 'url'=>array('update', 'id'=>$model->campus_id)),
	array('label'=>'Delete Campus', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->campus_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Campus', 'url'=>array('admin')),
);
?>

<h1>View Campus #<?php echo $model->campus_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'campus_id',
		'campus_name',
		'college_id',
	),
)); ?>
