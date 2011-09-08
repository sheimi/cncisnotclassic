<?php
$this->breadcrumbs=array(
	$this->module->id,
);
?>

<h1><?php echo $this->uniqueId . '/' . $this->action->id; ?></h1>

<p>
This is the view content for action "<?php echo $this->action->id; ?>".
The action belongs to the controller "<?php echo get_class($this); ?>"
in the "<?php echo $this->module->id; ?>" module.
</p>
<p>
You may customize this page by editing <tt><?php echo __FILE__; ?></tt>
</p>

<div class="nav" id="nav">
  <?php $this->widget('zii.widgets.CMenu', array(
      'items'=>array(
        array('label'=>'Manage Users', 'url'=>array('/admin/users')),
        array('label'=>'Manage Teachers', 'url'=>array('/admin/teacher')),
        array('label'=>'Manage Myclass', 'url'=>array('/admin/myclass')),
        array('label'=>'Manage Departments', 'url'=>array('/admin/departments')),
        array('label'=>'Manage Major', 'url'=>array('/admin/major')),
        //array('label'=>'Manage Campus', 'url'=>array('/admin/users')),
        array('label'=>'Manage Course', 'url'=>array('/admin/course')),
        array('label'=>'Manage ActualClass', 'url'=>array('/admin/actualclass')),
        array('label'=>'Manage Books', 'url'=>array('/admin/books')),
        array('label'=>'Manage BookComments', 'url'=>array('/admin/bookcomment')),
      ),
    ));
  ?>
</div>
