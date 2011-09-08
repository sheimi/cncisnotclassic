<?php
$this->breadcrumbs=array(
	'Actualclasses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Actualclass', 'url'=>array('index')),
	array('label'=>'Manage Actualclass', 'url'=>array('admin')),
);
?>

<h1>Create Actualclass</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>