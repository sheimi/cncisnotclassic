<?php

$this->menu=array(
	array('label'=>'Create Actualclass', 'url'=>array('create')),
	array('label'=>'Manage Actualclass', 'url'=>array('admin')),
);
?>

<h1>Actualclasses</h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
      'dataProvider'=>$dataProvider,
      'selectableRows'=>0,
      'columns'=>array(
        array(
          'name'=>'class_id',
          'type'=>'raw',
          'value'=>'CHtml::link(
            $data->class_id, 
            array("actualclass/view", "id"=>$data->class_id))',
          ),
        array(
          'name' => 'course_id',
          'value' => '$data->course->course_name',
          ),
        'term',
        'grade',
        'credit',
        'period',
        'course_type',
        array(
          'name' => 'major_id',
          'value' => '$data->major->major_name',
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
