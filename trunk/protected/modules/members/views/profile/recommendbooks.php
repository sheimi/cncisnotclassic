<div id="recommendbooks">
<h3 class="box-title">我推荐的书籍&nbsp;&nbsp;<span></span></h3>
<div class="content-box">
	<?php foreach ($recommendBookList as $book){?>
		<div class="book">
			<img src="<?php echo $book['image'];?>">
			<?php echo $book['book_name']?>
		</div>
	<?php }?>
	<div class="clear_float"></div>
</div>
</div>