<?php
$this->menu=array(
	array('label'=>'List Bookcomment', 'url'=>array('index')),
	array('label'=>'Manage Bookcomment', 'url'=>array('admin')),
);
?>

<h1>Create Bookcomment</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>