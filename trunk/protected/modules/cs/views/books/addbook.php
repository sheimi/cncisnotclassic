<?php
$this->breadcrumbs=array(
	'Books'=>array('/cs/books'),
	'Addbook',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>
<h1>这个页面是给用户添加相关书籍的，首先必然要先显示他当前在为 哪门课程添加书籍，其次是尽量不要重复，故需要列出已经添加了的书籍</h1>
<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>
<div>
	<h1>你正在为  课程XXX推荐书籍</h1>
	
	<form>
		<div style="width:200px;float:left;">
			<img name="book_cover" style="float:left;" src="<?php echo Yii::app()->request->baseUrl;?>/images/100.png" width="100" height="100">
			<a>封面错了，我要修改</a>
		</div>
		<div>
		<label for="book_name">书名</label>
		<input type="text" name="book_name" >
		</div>
		
		<div>
		<label for="">推荐理由</label>
		<textarea name="comment" ></textarea>
		</div>
		
		<input type="submit" name="submit" value="确认提交">
	</form>
</div>