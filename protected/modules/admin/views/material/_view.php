<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('material_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->material_id), array('view', 'id'=>$data->material_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('material_name')); ?>:</b>
	<?php echo CHtml::encode($data->material_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('material_path')); ?>:</b>
	<?php echo CHtml::encode($data->material_path); ?>
	<br />


</div>