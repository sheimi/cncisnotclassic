<?php

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Create Users', 'url'=>array('create')),
	array('label'=>'Update Users', 'url'=>array('update', 'id'=>$model->user_id)),
	array('label'=>'Delete Users', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->user_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<h1>View Users #<?php echo $model->user_id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'user_id',
		'bbs_name',
		'major_id',
		'email',
		'grade',
		'njuid',
		'real_name',
		'username',
		'password',
		'avatar_path',
	),
));
$labels = $model->attributeLabels();
?> 
<ul>
  <li>
    <div>
      <?php echo '<div class="item-key">'
                    .$labels['user_id']
                .'</div> <div class="item-value">'
                    .$model->user_id.'</div>'?>
    </div>
  </li>
  <li>
    <div>
      <?php echo '<div class="item-key">'
                    .$labels['bbs_name']
                .'</div> <div class="item-value">'
                    .$model->bbs_name.'</div>'?>
    </div>
  </li>
  <li>
    <div>
      <?php echo '<div class="item-key">'
                    .$labels['major_id']
                .'</div> <div class="item-value">'
                    .$model->major->major_name.'</div>'?>
      <?php echo $labels['major_id'].' '.$model->major->major_name?>
    </div>
  </li>
  <li>
    <div>
      <?php echo '<div class="item-key">'
                    .$labels['email']
                .'</div> <div class="item-value">'
                    .$model->email.'</div>'?>
      <?php echo $labels['grade'].' '.$model->email?>
    </div>
  </li>
  <li>
    <div>
      <?php echo '<div class="item-key">'
                    .$labels['grade']
                .'</div> <div class="item-value">'
                    .$model->grade.'</div>'?>
    </div>
  </li>
  <li>
    <div>
      <?php echo '<div class="item-key">'
                    .$labels['njuid']
                .'</div> <div class="item-value">'
                    .$model->njuid.'</div>'?>
    </div>
  </li>
  <li>
    <div>
      <?php echo '<div class="item-key">'
                    .$labels['real_name']
                .'</div> <div class="item-value">'
                    .$model->real_name.'</div>'?>
    </div>
  </li>
  <li>
    <div>
      <?php echo '<div class="item-key">'
                    .$labels['username']
                .'</div> <div class="item-value">'
                    .$model->username.'</div>'?>
    </div>
  </li>
</ul>

