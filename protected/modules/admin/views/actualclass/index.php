<?php
$this->breadcrumbs=array(
	'Actualclasses',
);

$this->menu=array(
	array('label'=>'Create Actualclass', 'url'=>array('create')),
	array('label'=>'Manage Actualclass', 'url'=>array('admin')),
);
?>

<h1>Actualclasses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
