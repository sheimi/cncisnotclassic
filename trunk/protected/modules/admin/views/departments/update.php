<?php
$this->breadcrumbs=array(
	'Departments'=>array('index'),
	$model->dep_id=>array('view','id'=>$model->dep_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Departments', 'url'=>array('index')),
	array('label'=>'Create Departments', 'url'=>array('create')),
	array('label'=>'View Departments', 'url'=>array('view', 'id'=>$model->dep_id)),
	array('label'=>'Manage Departments', 'url'=>array('admin')),
);
?>

<h1>Update Departments <?php echo $model->dep_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>