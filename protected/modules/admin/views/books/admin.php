<?php

$this->menu=array(
	array('label'=>'List Books', 'url'=>array('index')),
	array('label'=>'Create Books', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('books-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Books</h1>

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
	'id'=>'books-grid',
  'selectableRows'=>0,
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		'book_id',
		'book_name',
		'isbn',
		'provider',
		'cover_path',
		'add_time',
		/*
		'author',
		'publisher',
		'comment',
		'pubdate',
		'price',
		*/
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
