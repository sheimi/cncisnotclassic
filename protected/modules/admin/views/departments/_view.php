<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('dep_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->dep_id), array('view', 'id'=>$data->dep_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dep_name')); ?>:</b>
	<?php echo CHtml::encode($data->dep_name); ?>
	<br />


</div>