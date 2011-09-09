<?php

$this->menu=array(
	array('label'=>'Create Course', 'url'=>array('create')),
	array('label'=>'Manage Course', 'url'=>array('admin')),
);
?>

<h1>Courses</h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
      'dataProvider'=>$dataProvider,
      'selectableRows'=>0,
      'columns'=>array(array(
          'name'=>'course_name',
          'type'=>'raw',
          'value'=>'CHtml::link(
            $data->course_name, 
            array("course/view", "id"=>$data->course_id))',
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
