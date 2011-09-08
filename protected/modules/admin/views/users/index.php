<?php
$this->breadcrumbs=array(
	'Users',
);

$this->menu=array(
	array('label'=>'Create Users', 'url'=>array('create')),
	array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<h1>Users</h1>

<?php
$dataProvider = new CActiveDataProvider('Users', array(
                    'Pagination' => array (
                      'pageSize' => 50
                    ),
                    //'criteria'=>array(
                    //'with' => array('major'),
                    //),
                  )); 
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
  'pager'=>array(
    'pageSize'=>50
  ),
  'columns'=>array(
    array(
      'name'=>'username',
      'type'=>'raw',
      'value'=>'CHtml::link(
        $data->username, 
        array("users/view", "id"=>$data->user_id))',
    ),
    'password',
    'real_name',
    'bbs_name',
    array(
      'name' => 'major_id',
      'value' => '$data->major->major_name',
    ),
    'email',
    'grade',
    'njuid',
  ),
	//'itemView'=>'_view',
)); ?>
