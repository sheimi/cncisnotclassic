<?php
$this->menu=array(
	array('label'=>'List Bookcomment', 'url'=>array('index')),
	array('label'=>'Create Bookcomment', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('bookcomment-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Bookcomments</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'bookcomment-grid',
  'selectableRows'=>0,
	'dataProvider'=>$dataProvider,
	'filter'=>$model,
	'columns'=>array(
		'bookcomment_id',
    array(
      'name' => 'book_id',
      'value' => '$data->book->book_name',
    ),
    array(
      'name' => 'user_id',
      'value' => '$data->user->username',
    ),
		'add_time',
		'star',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<script>
$(document).ready(function() {
  $('.items tr').click(function() {
		if ($(this).attr("class") == "filters")
			return;
    window.location = $(this).find('a').attr('href');
  });
});
</script>
