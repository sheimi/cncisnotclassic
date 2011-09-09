<h3 class="box-title">我推荐的书籍<span></span></h3>
<div id="recommendbooks">
<div class="content-box">
	<?php foreach ($recommendBookList as $book){?>
		<div class="book">
			<a href="<?php echo Yii::app()->request->baseUrl . '/index.php?r=cs/books/viewbook&bid=' . $book['book_id'];?>">
			<img src="<?php echo $book['image'];?>">
			</a>
			<?php echo $book['book_name']?>
		</div>
	<?php }?>
	<div class="clear_float"></div>
</div>
</div>