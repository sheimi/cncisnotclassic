<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('campus_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->campus_id), array('view', 'id'=>$data->campus_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('campus_name')); ?>:</b>
	<?php echo CHtml::encode($data->campus_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('college_id')); ?>:</b>
	<?php echo CHtml::encode($data->college_id); ?>
	<br />


</div>