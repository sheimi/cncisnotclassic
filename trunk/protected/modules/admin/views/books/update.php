<?php
$this->breadcrumbs=array(
	'Books'=>array('index'),
	$model->book_id=>array('view','id'=>$model->book_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Books', 'url'=>array('index')),
	array('label'=>'Create Books', 'url'=>array('create')),
	array('label'=>'View Books', 'url'=>array('view', 'id'=>$model->book_id)),
	array('label'=>'Manage Books', 'url'=>array('admin')),
);
?>

<h1>Update Books <?php echo $model->book_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>