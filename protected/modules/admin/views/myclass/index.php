<?php

$this->menu=array(
	array('label'=>'Create Myclass', 'url'=>array('create')),
	array('label'=>'Manage Myclass', 'url'=>array('admin')),
);
?>

<h1>Myclasses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
