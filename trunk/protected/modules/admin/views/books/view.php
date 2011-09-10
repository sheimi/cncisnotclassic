<?php
$this->menu=array(
	array('label'=>'List Books', 'url'=>array('index')),
	array('label'=>'Create Books', 'url'=>array('create')),
	array('label'=>'Update Books', 'url'=>array('update', 'id'=>$model->book_id)),
	array('label'=>'Delete Books', 'url'=>'#'),
	//array('label'=>'Delete Books', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->book_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Books', 'url'=>array('admin')),
);
?>

<h1>View Books #<?php echo $model->book_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'book_id',
		'book_name',
		'isbn',
		'provider',
		'cover_path',
		'add_time',
		'author',
		'publisher',
		'comment',
		'pubdate',
		'price',
	),
)); ?>

<script>
$(document).ready(function() {
  $('.operations a').each(function() {
    if($(this).attr('href') == '#') {
      $(this).click(function() {
        $.ajax({
          type: 'POST',
          url: '<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=admin/books/delete&id=<?php echo $model->book_id?>',
          success: function($data) {
            window.location = '<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=admin/books/index';
          }
        })
      });
    }
  })
})
</script>