<?php
$this->menu=array(
	array('label'=>'List Bookcomment', 'url'=>array('index')),
	array('label'=>'Create Bookcomment', 'url'=>array('create')),
	array('label'=>'Update Bookcomment', 'url'=>array('update', 'id'=>$model->bookcomment_id)),
	array('label'=>'Delete Bookcomment', 'url'=>'#'),
	//array('label'=>'Delete Bookcomment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->bookcomment_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Bookcomment', 'url'=>array('admin')),
);
?>

<h1>View Bookcomment #<?php echo $model->bookcomment_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'bookcomment_id',
		'book_id',
		'user_id',
		'content',
		'add_time',
		'star',
	),
)); ?>

<script>
$(document).ready(function() {
  $('.operations a').each(function() {
    if($(this).attr('href') == '#') {
      $(this).click(function() {
        $.ajax({
          type: 'POST',
          url: '<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=admin/bookcomment/delete&id=<?php echo $model->bookcomment_id?>',
          success: function($data) {
            window.location = '<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=admin/bookcomment/index';
          }
        })
      });
    }
  })
})
</script>