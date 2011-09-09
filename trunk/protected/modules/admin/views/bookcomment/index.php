<?php

$this->menu=array(
	array('label'=>'Create Bookcomment', 'url'=>array('create')),
	array('label'=>'Manage Bookcomment', 'url'=>array('admin')),
);
?>

<h1>Bookcomments</h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
      'dataProvider'=>$dataProvider,
      'selectableRows'=>0,
      'columns'=>array(
        array(
          'name'=>'bookcomment_id',
          'type'=>'raw',
          'value'=>'CHtml::link(
            $data->bookcomment_id, 
            array("bookcomment/view", "id"=>$data->bookcomment_id))',
          ),
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

