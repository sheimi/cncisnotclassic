<?php
$this->menu=array(
	array('label'=>'Create Bookcomment', 'url'=>array('create')),
	array('label'=>'Manage Bookcomment', 'url'=>array('admin')),
);
?>

<h1>Bookcomments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
