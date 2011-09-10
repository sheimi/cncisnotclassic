<?php
$this->menu=array(
	array('label'=>'List Course', 'url'=>array('index')),
	array('label'=>'Create Course', 'url'=>array('create')),
	array('label'=>'Update Course', 'url'=>array('update', 'id'=>$model->course_id)),
	array('label'=>'Delete Course', 'url'=>'#'),
	//array('label'=>'Delete Course', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->course_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Course', 'url'=>array('admin')),
);
?>

<h1>View Course #<?php echo $model->course_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'course_id',
		'course_name',
	),
)); ?>

<script>
$(document).ready(function() {
  $('.operations a').each(function() {
    if($(this).attr('href') == '#') {
      $(this).click(function() {
        $.ajax({
          type: 'POST',
          url: '<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=admin/course/delete&id=<?php echo $model->course_id?>',
          success: function($data) {
            window.location = '<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=admin/course/index';
          }
        })
      });
    }
  })
})
</script>