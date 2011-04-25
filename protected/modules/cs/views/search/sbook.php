<?php
$this->breadcrumbs=array(
	'搜索',
);?>

<div id="content-left">
    <h3 class="result-desc"><?php echo $q; ?>&nbsp;&nbsp;搜索到的结果为：</h3>
    
    <?php $index = 1;if(sizeof($bookList) != 0)foreach ($bookList as $book) {
    ?>
    <div class="book-brief">
    	<div class="book-name">
	    	<a href="index.php?r=cs/books/viewbook&bid=<?php echo $book->book_id;?>"><?php echo $book->book_name; ?></a>
	    	<div class="more-detail"><a href="">书籍详情</a></div>
    	</div>
    	<div>
    		<h6>相关课程</h6>
    		<div>
    			<div>软件学院 <strong>Linux 程序设计</strong></div>
    			<div>计算机系 <strong>操作系统</strong></div>
    		</div>
    		<div class="have-book">
        		<h6>有此书的Njuer</h6>
        		<a href="#">XXXX</a>&nbsp;&nbsp;<a href="#">XXXX</a>&nbsp;&nbsp;<a href="#">XXXX</a>&nbsp;&nbsp;<a href="#">XXXX</a>&nbsp;&nbsp;
    		</div>
    	</div>
    </div>
    <?php }?>
</div>
<div id="content-right">
	<div class="side-box">
		<div class="title">书籍搜索排行</div>
		dsafds<br>
		dsafds<br>
		dsafds<br>
		dsafds<br>
		dsafds<br>
	</div>
	<div class="side-box">
		<div class="title">上传书籍最多的Njuer</div>
		dsafds<br>
		dsafds<br>
		dsafds<br>
		dsafds<br>
		dsafds<br>
	</div>
	<div class="side-box">
		<div class="title">你说在院系动态</div>
		dsafds<br>
		dsafds<br>
		dsafds<br>
		dsafds<br>
		dsafds<br>
	</div>
</div>