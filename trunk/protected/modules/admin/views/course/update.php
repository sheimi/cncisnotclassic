<?php
$this->menu=array(
	array('label'=>'List Course', 'url'=>array('index')),
	array('label'=>'Create Course', 'url'=>array('create')),
	array('label'=>'View Course', 'url'=>array('view', 'id'=>$model->course_id)),
	array('label'=>'Manage Course', 'url'=>array('admin')),
);
?>

<h1>Update Course <?php echo $model->course_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>