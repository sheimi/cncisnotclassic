<?php

$this->menu=array(
	array('label'=>'Create Teacher', 'url'=>array('create')),
	array('label'=>'Manage Teacher', 'url'=>array('admin')),
);
?>

<h1>Teachers</h1>


<?php
$this->widget('zii.widgets.grid.CGridView', array(
      'dataProvider'=>$dataProvider,
      'selectableRows'=>0,
      'columns'=>array(
        array(
          'name'=>'teacher_name',
          'type'=>'raw',
          'value'=>'CHtml::link(
            $data->teacher_name, 
            array("teacher/view", "id"=>$data->teacher_id))',
          ),
        ),
      )); ?>
<script>
$(document).ready(function() {
  $('.items tr').click(function() {
    window.location = $(this).find('a').attr('href');
  });
});
</script>