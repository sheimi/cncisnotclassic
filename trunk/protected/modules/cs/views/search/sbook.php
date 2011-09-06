<?php
$this->breadcrumbs=array(
	'搜索',
);?>
<div id="content-left" class="sbook">
    <?php echo $this->renderPartial('../search-box', array('model'=>$model)); ?>
    <h3 class="result-desc"><span class="keyword"><?php echo $q; ?></span>&nbsp;&nbsp;搜索到的结果为：</h3>
    
    <?php $index = 1;if(sizeof($bookList) != 0)foreach ($bookList as $book) {?>
    <div class="book-brief">
    	<div class="book-name">
	    	<a href="index.php?r=cs/books/viewbook&bid=<?php echo $book['book_id'];;?>"><?php echo $book['book_name']; ?></a>
	    	<div class="more-detail"><a href="">书籍详情</a></div>
    	</div>
    	<div>
    		<div class="rel-course">
    			<h6>相关课程</h6>
    			<?php foreach ($book['relcourse'] as $relCourse){?>
    			<div><strong><a href="<?php echo Yii::app()->request->baseUrl . '/index.php?r=cs/course/view&cid=' . $relCourse['course_id'];?>"><?php echo $relCourse['course_name'];?></a></strong></div>
    			<?php }?>
    		</div>
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
    	</div>
    </div>
    <?php }?>
</div>
<div id="content-right">
	<div class="side-box">
		<div class="title">书籍搜索排行</div>
		<ol>
		<?php foreach ($mostViewdBook as $book){?>
			<li><a href="<?php echo Yii::app()->request->baseUrl . '/index.php?r=cs/books/viewbook&bid=' . $book['book_id'];?>"><?php echo $book['book_name']; ?></a>(<?php echo $book['total'];?>次查看)</li>
		<?php }?>
		</ol>
	</div>
	<div class="side-box">
		<div class="title">推荐书籍最多的Njuer</div>
		<?php foreach ($activeUserList as $activeUser){?>
			<span><a href="<?php echo Yii::app()->request->baseUrl . '/index.php?r=members/profile/view&uid=' . $activeUser['user_id'];?>"><?php echo $activeUser['username'];?></a></span>
		<?php }?>
	</div>
</div>