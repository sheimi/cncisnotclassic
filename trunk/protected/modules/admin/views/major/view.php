<?php
$this->menu=array(
	array('label'=>'List Major', 'url'=>array('index')),
	array('label'=>'Create Major', 'url'=>array('create')),
	array('label'=>'Update Major', 'url'=>array('update', 'id'=>$model->major_id)),
	array('label'=>'Delete Major', 'url'=>'#'),
	//array('label'=>'Delete Major', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->major_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Major', 'url'=>array('admin')),
);
?>

<h1>View Major #<?php echo $model->major_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'major_id',
		'dep_id',
		'major_name',
	),
)); ?>


<script>
$(document).ready(function() {
  $('.operations a').each(function() {
    if($(this).attr('href') == '#') {
      $(this).click(function() {
        $.ajax({
          type: 'POST',
          url: '<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=admin/major/view&id=<?php echo $model->major_id?>',
          success: function($data) {
            window.location = '<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=major/major/index';
          }
        })
      });
    }
  })
})
</script>