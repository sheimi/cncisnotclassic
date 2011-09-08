<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('myclass_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->myclass_id), array('view', 'id'=>$data->myclass_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('class_name')); ?>:</b>
	<?php echo CHtml::encode($data->class_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day')); ?>:</b>
	<?php echo CHtml::encode($data->day); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('classroom')); ?>:</b>
	<?php echo CHtml::encode($data->classroom); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('week_info')); ?>:</b>
	<?php echo CHtml::encode($data->week_info); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_id')); ?>:</b>
	<?php echo CHtml::encode($data->member_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('actualclass_id')); ?>:</b>
	<?php echo CHtml::encode($data->actualclass_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('time')); ?>:</b>
	<?php echo CHtml::encode($data->time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('custom')); ?>:</b>
	<?php echo CHtml::encode($data->custom); ?>
	<br />

	*/ ?>

</div>