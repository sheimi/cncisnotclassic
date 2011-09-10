<?php

$this->menu=array(
	array('label'=>'List Myclass', 'url'=>array('index')),
	array('label'=>'Create Myclass', 'url'=>array('create')),
	array('label'=>'View Myclass', 'url'=>array('view', 'id'=>$model->myclass_id)),
	array('label'=>'Manage Myclass', 'url'=>array('admin')),
);
?>

<h1>Update Myclass <?php echo $model->myclass_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>