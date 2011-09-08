<?php
$this->breadcrumbs=array(
	'Bookcomments'=>array('index'),
	$model->bookcomment_id=>array('view','id'=>$model->bookcomment_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Bookcomment', 'url'=>array('index')),
	array('label'=>'Create Bookcomment', 'url'=>array('create')),
	array('label'=>'View Bookcomment', 'url'=>array('view', 'id'=>$model->bookcomment_id)),
	array('label'=>'Manage Bookcomment', 'url'=>array('admin')),
);
?>

<h1>Update Bookcomment <?php echo $model->bookcomment_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>