<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('book_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->book_id), array('view', 'id'=>$data->book_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('book_name')); ?>:</b>
	<?php echo CHtml::encode($data->book_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isbn')); ?>:</b>
	<?php echo CHtml::encode($data->isbn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('provider')); ?>:</b>
	<?php echo CHtml::encode($data->providerdetail->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cover_path')); ?>:</b>
	<?php echo CHtml::encode($data->cover_path); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('add_time')); ?>:</b>
	<?php echo CHtml::encode($data->add_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('author')); ?>:</b>
	<?php echo CHtml::encode($data->author); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('publisher')); ?>:</b>
	<?php echo CHtml::encode($data->publisher); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
	<?php echo CHtml::encode($data->comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pubdate')); ?>:</b>
	<?php echo CHtml::encode($data->pubdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	*/ ?>

</div>