<?php
$this->breadcrumbs=array(
	'Search',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>
<h1 style="color:red">这是课本的搜索结果</h1>
<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>



<div>
<h4><?php echo $q; ?>&nbsp;&nbsp;搜索到的结果为：</h4>
<?php $index = 1;if(sizeof($bookList) != 0)foreach ($bookList as $book) {
?>
<div>
	<?php echo $index++.'&nbsp;&nbsp;&nbsp;';?><a href="index.php?r=cs/books/viewbook&bid=<?php echo $book->book_id;?>">《<?php echo $book->book_name; ?>》</a>
	<div>
		<h6>与此书有关的NJU课程</h6>
		<div>
			<div>软件学院 <strong>Linux 程序设计</strong></div>
			<div>计算机系 <strong>操作系统</strong></div>
		</div>
		<h6>&nbsp;</h6>
		<h6>有此书的Njuer</h6>
		<a href="#">XXXX</a>&nbsp;&nbsp;<a href="#">XXXX</a>&nbsp;&nbsp;<a href="#">XXXX</a>&nbsp;&nbsp;<a href="#">XXXX</a>&nbsp;&nbsp;
	</div>
</div>
<h1>
&nbsp;
</h1>
<?php }?>
</div>