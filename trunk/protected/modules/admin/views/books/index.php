<?php

$this->menu=array(
	array('label'=>'Create Books', 'url'=>array('create')),
	array('label'=>'Manage Books', 'url'=>array('admin')),
);
?>

<h1>Books</h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
      'dataProvider'=>$dataProvider,
      'selectableRows'=>0,
      'columns'=>array(
        array(
          'name'=>'book_name',
          'type'=>'raw',
          'value'=>'CHtml::link(
            $data->book_name, 
            array("books/view", "id"=>$data->book_id))',
          ),
        array(
          'name' => 'provider',
          'value' => '$data->providerdetail->username',
          ),
        ),
      //'itemView'=>'_view',
      )); ?>
<script>
$(document).ready(function() {
  $('.items tr').click(function() {
    window.location = $(this).find('a').attr('href');
  });
});
</script>