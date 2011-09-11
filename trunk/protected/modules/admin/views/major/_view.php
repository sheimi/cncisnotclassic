<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('major_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->major_id), array('view', 'id'=>$data->major_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dep_id')); ?>:</b>
	<?php echo CHtml::encode($data->dep->dep_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('major_name')); ?>:</b>
	<?php echo CHtml::encode($data->major_name); ?>
	<br />


</div>