<?php $index = 1;if(sizeof($bookList) != 0)foreach ($bookList as $book) {?>
<div class="book-brief">
	<div class="book-name">
    	<a href="index.php?r=cs/books/viewbook&bid=<?php echo $book['book_id'];;?>"><?php echo $book['book_name']; ?></a>
    	<!-- <div class="more-detail"><a href="">书籍详情</a></div>  -->
	</div>
	<div>
		<?php if(sizeof($book['relcourse'])){?>
		<div class="rel-course">
			<h6>相关课程</h6>
			<?php foreach ($book['relcourse'] as $relCourse){?>
			<div class="rel-book-name"><strong><a href="<?php echo Yii::app()->request->baseUrl . '/index.php?r=cs/course/view&cid=' . $relCourse['course_id'];?>"><?php echo $relCourse['course_name'];?></a></strong></div>
			<?php }?>
			<div class="clear_float"></div>
		</div>
		<?php }?>
		<?php if(sizeof($book['ownerList']) > 0){?>
		<div class="have-book">
    		<h6>有此书的Njuer</h6>
    		<?php foreach ($book['ownerList'] as $owner){?>
    			<?php if($owner['access'] == 'borrow'){?>
    			<span class="book-owner for-borrow" title="有此书可借">
    			<?php }elseif($owner['access'] == 'sell'){?>
    			<span class="book-owner for-sell" title="有此书可卖" >
    			<?php }else{?>
    			<span class="book-owner" title="正在使用这本书" >
    			<?php }?>
    				<a href="<?php echo Yii::app()->request->baseUrl . '/index.php?r=members/profile/view&uid=' . $owner['userid'];?>"><?php echo $owner['username'];?></a>
    			</span>
    		<?php }?>
		</div>
		<?php }?>
	</div>
</div>
<?php }else{?>
	找不到和您的查询 "<?php echo $q;?>" 相符的内容或信息。
<?php }?>