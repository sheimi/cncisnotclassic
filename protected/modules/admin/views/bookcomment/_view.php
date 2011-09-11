<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('bookcomment_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->bookcomment_id), array('view', 'id'=>$data->bookcomment_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('book_id')); ?>:</b>
	<?php echo CHtml::encode($data->book->book_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php
	$content = $data->content;
	if (strlen($content) >= 100) {
		$content = substr($content, 0, 201).'......';
	}
	echo CHtml::encode($content);
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('add_time')); ?>:</b>
	<?php echo CHtml::encode($data->add_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('star')); ?>:</b>
	<?php echo CHtml::encode($data->star); ?>
	<br />


</div>