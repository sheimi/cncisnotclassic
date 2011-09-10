<?php

$this->menu=array(
	array('label'=>'List Major', 'url'=>array('index')),
	array('label'=>'Manage Major', 'url'=>array('admin')),
);
?>

<h1>Create Major</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>