<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('teacher_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->teacher_id), array('view', 'id'=>$data->teacher_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('teacher_name')); ?>:</b>
	<?php echo CHtml::encode($data->teacher_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sex')); ?>:</b>
	<?php echo CHtml::encode($data->sex); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('introduction')); ?>:</b>
	<?php echo CHtml::encode($data->introduction); ?>
	<br />


</div>