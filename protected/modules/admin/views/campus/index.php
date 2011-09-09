<?php

$this->menu=array(
	array('label'=>'Create Campus', 'url'=>array('create')),
	array('label'=>'Manage Campus', 'url'=>array('admin')),
);
?>

<h1>Campuses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
