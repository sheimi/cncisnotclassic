<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('course_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->course_id), array('view', 'id'=>$data->course_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('course_name')); ?>:</b>
	<?php echo CHtml::encode($data->course_name); ?>
	<br />


</div>