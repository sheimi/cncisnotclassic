<?php

$this->menu=array(
	array('label'=>'List Myclass', 'url'=>array('index')),
	array('label'=>'Manage Myclass', 'url'=>array('admin')),
);
?>

<h1>Create Myclass</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>