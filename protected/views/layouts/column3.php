<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
  <div id="content">
    <div id="content-left">
      <?php echo $content; ?>
    </div><!-- content -->
    <div id="content-right">
    <?php
      $this->beginWidget('zii.widgets.CPortlet', array(
        'title'=>'Operations',
      ));
      $this->widget('zii.widgets.CMenu', array(
        'items'=>$this->menu,
        'htmlOptions'=>array('class'=>'operations'),
      ));
      $this->endWidget();
    ?>
    </div><!-- sidebar -->
  </div>
</div>
<?php $this->endContent(); ?>
