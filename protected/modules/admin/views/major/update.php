<?php
$this->breadcrumbs=array(
	'Majors'=>array('index'),
	$model->major_id=>array('view','id'=>$model->major_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Major', 'url'=>array('index')),
	array('label'=>'Create Major', 'url'=>array('create')),
	array('label'=>'View Major', 'url'=>array('view', 'id'=>$model->major_id)),
	array('label'=>'Manage Major', 'url'=>array('admin')),
);
?>

<h1>Update Major <?php echo $model->major_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>