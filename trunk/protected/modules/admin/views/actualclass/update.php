<?php
$this->breadcrumbs=array(
	'Actualclasses'=>array('index'),
	$model->class_id=>array('view','id'=>$model->class_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Actualclass', 'url'=>array('index')),
	array('label'=>'Create Actualclass', 'url'=>array('create')),
	array('label'=>'View Actualclass', 'url'=>array('view', 'id'=>$model->class_id)),
	array('label'=>'Manage Actualclass', 'url'=>array('admin')),
);
?>

<h1>Update Actualclass <?php echo $model->class_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>