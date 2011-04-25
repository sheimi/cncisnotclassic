<?php
$this->breadcrumbs=array(
	'My Class',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<h1>显示用户个人的课程表，可自定义的课程表</h1>

<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>
<script type="text/javascript" src="js/jquery.jeditable.js"></script> 
<script type="text/javascript">
<!--

function editable(){
	
}
$(function(){ 
    $('.edit').editable('<?php echo Yii::app()->request->baseUrl . '/index.php?r=members/myclass/edit';?>', {  
        name	  :'value',
        width     :'auto', 
        height    :'auto',
        type 	  :'textarea',
        submit	  : '保存',
      	onblur    : 'cancel', 
        event     :'dblclick.editable',
        indicator : '<img src="loader.gif">', 
        tooltip   : '双击可以编辑...' 
    }); 
});
//-->
</script>

<div>
	<?php if($errorMsg){?>
	<ul>
		<?php foreach ($errorMsg as $em){?>
			<li><?php echo $em;?></li>
		<?php }?>
	</ul>
	<?php }else {?>
		<?php if (is_array($return)){?>
			<!-- 根据取出的课程数据，生成一张课表 -->
			<table>
				<tr>
					<th style="border:1px solid #aaa; width:90px; height:36px;padding:0px;">选项</th>
					<th style="border:1px solid #aaa; width:90px; height:36px;padding:0px;">星期一</th>
					<th style="border:1px solid #aaa; width:90px; height:36px;padding:0px;">星期二</th>
					<th style="border:1px solid #aaa; width:90px; height:36px;padding:0px;">星期三</th>
					<th style="border:1px solid #aaa; width:90px; height:36px;padding:0px;">星期四</th>
					<th style="border:1px solid #aaa; width:90px; height:36px;padding:0px;">星期五</th>
					<th style="border:1px solid #aaa; width:90px; height:36px;padding:0px;">星期六</th>
					<th style="border:1px solid #aaa; width:90px; height:36px;padding:0px;">星期天</th>
				</tr>
				<?php $i = 1; for($outer = 0; $outer < 10; $outer++){?>
					<tr>
						<td style="border:1px solid #aaa; width:90px; height:36px;padding:0px;"><?php echo '第' . $i++ . '节';?></td>
						<?php for($week = 0; $week < 7; $week++){?>
							<td id="<?php echo $return[$outer * 7 + $week]['myclass_id'];?>" class="edit"  style="border:1px solid #aaa; width:90px; height:36px;padding:0px;">
							<?php if(!$return[$outer * 7 + $week]['custom']){?>
    						    <?php echo $return[$outer * 7 + $week]['class_name'].' '; ?>
    						    <?php //echo $return[$outer * 7 + $week]['classroom']; ?>
    						<?php }else{?>
    							<?php echo $return[$outer * 7 + $week]['custom']; ?>
    						<?php }?>
							</td>
						<?php }?>
					</tr>
				<?php }?>
			</table>
		<?php }else{?>
			<p>你还未初始化你的课表，初始化之后可以自定义课表，建议你  <a>初始化</a></p>
		<?php }?>
	<?php }?>
</div>