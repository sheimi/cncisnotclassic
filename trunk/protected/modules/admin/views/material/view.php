<?php

$this->menu=array(
	array('label'=>'List Material', 'url'=>array('index')),
	array('label'=>'Create Material', 'url'=>array('create')),
	array('label'=>'Update Material', 'url'=>array('update', 'id'=>$model->material_id)),
	array('label'=>'Delete Material', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->material_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Material', 'url'=>array('admin')),
);
?>

<h1>View Material #<?php echo $model->material_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'material_id',
		'material_name',
		'material_path',
	),
)); ?>
