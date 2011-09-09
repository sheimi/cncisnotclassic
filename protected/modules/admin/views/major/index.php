<?php

$this->menu=array(
	array('label'=>'Create Major', 'url'=>array('create')),
	array('label'=>'Manage Major', 'url'=>array('admin')),
);
?>

<h1>Majors</h1>


<?php
$this->widget('zii.widgets.grid.CGridView', array(
      'dataProvider'=>$dataProvider,
      'selectableRows'=>0,
      'columns'=>array(
        array(
          'name'=>'major_name',
          'type'=>'raw',
          'value'=>'CHtml::link(
            $data->major_name, 
            array("major/view", "id"=>$data->major_id))',
          ),
        array(
          'name'=>'dep_id',
          'value'=>'$data->dep->dep_name',
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