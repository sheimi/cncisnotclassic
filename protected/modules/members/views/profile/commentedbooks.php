<div class="box-title">我评价过的书籍</div>
<div class="content-box">
	<?php foreach ($updownBookList as $item){?>
		<div class="book">
			<img src="<?php echo $item['book']['image'];?>">
			<?php echo $item['book']['book_name']?>
		</div>
	<?php }?>
	<div class="clear_float"></div>
</div>