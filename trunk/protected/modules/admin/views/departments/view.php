<?php

$this->menu=array(
	array('label'=>'List Departments', 'url'=>array('index')),
	array('label'=>'Create Departments', 'url'=>array('create')),
	array('label'=>'Update Departments', 'url'=>array('update', 'id'=>$model->dep_id)),
  array('label'=>'Delete Departments', 'url'=>'#'),
	//array('label'=>'Delete Departments', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->dep_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Departments', 'url'=>array('admin')),
);
?>

<h1>View Departments #<?php echo $model->dep_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'dep_id',
		'dep_name',
	),
)); ?>

<script>
$(document).ready(function() {
  $('.operations a').each(function() {
    if($(this).attr('href') == '#') {
      $(this).click(function() {
        $.ajax({
          type: 'POST',
          url: '<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=admin/departments/delete&id=<?php echo $model->dep_id?>',
          success: function($data) {
            window.location = '<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=admin/users/index';
          }
        })
      });
    }
  })
})
</script>