<div class="box-title">我评价过的书籍&nbsp;&nbsp;<span><a href="index.php?r=members/profile/commentedbooks">查看全部&gt;&gt;</a></span></div>
<div class="content-box">
	<?php foreach ($updownBookList as $item){?>
		<div class="book">
			<img src="<?php echo $item['book']['image'];?>">
			<?php echo $item['book']['book_name']?>
		</div>
	<?php }?>
	<div class="clear_float"></div>
</div>