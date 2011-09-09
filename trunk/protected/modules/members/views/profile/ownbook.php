<div id="recommendbooks">
<h3 class="box-title">我拥有的书</h3>
<div class="content-box">
	<?php foreach ($ownbookList as $book){?>
		<div  class="book">
			<a href="<?php echo Yii::app()->request->baseUrl . '/index.php?r=cs/books/viewbook&bid=' . $book['book_id'];?>">
			<img title="<?php echo $book['book_name']?>" src="<?php echo $book['image'];?>">
			</a>
			<?php if($book['access'] == 'borrow'){
			    $access = '可借';
	        }else if($book['access'] == 'sell'){
	             $access = '可卖';
	        }else{
	        }?>
			<div style="display:block;height:1.2em;overflow:hidden;" title="<?php echo $book['book_name']?>"><?php if($access) echo "<$access>"; ?><?php echo $book['book_name']?></div>
		</div>
	<?php }?>
	<div class="clear_float"></div>
</div>
</div>