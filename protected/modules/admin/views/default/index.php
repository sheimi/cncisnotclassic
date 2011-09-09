<div id="content-left">

  <div class="nav" id="nav">
    <?php $this->widget('zii.widgets.CMenu', array(
        'items'=>array(
          array('label'=>'Manage Users', 'url'=>array('/admin/users')),
          array('label'=>'Manage Teachers', 'url'=>array('/admin/teacher')),
          //array('label'=>'Manage Myclass', 'url'=>array('/admin/myclass')),
          array('label'=>'Manage Departments', 'url'=>array('/admin/departments')),
          array('label'=>'Manage Major', 'url'=>array('/admin/major')),
          //array('label'=>'Manage Campus', 'url'=>array('/admin/users')),
          array('label'=>'Manage Course', 'url'=>array('/admin/course')),
          array('label'=>'Manage ActualClass', 'url'=>array('/admin/actualclass')),
          array('label'=>'Manage Books', 'url'=>array('/admin/books')),
          array('label'=>'Manage BookComments', 'url'=>array('/admin/bookcomment')),
          //array('label'=>'Manage Material', 'url'=>array('/admin/material')),
        ),
      ));
    ?>
  </div>
</div>
