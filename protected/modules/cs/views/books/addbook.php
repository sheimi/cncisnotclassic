<?php
$this->breadcrumbs=array(
	'书籍'=>array('/cs/books'),
	'推荐书籍',
);?>

<div id="content-left" class="addbook">
	<div id="book-info">
    	<h1>为课程  <?php echo $course['course_name'];?> 推荐书籍</h1>
    	
    	<form method="post">
    	
    		<input type="hidden" name="r" value="cs/books/addbook">
    		<input type="hidden" name="cid" value="<?php echo $course['course_id'];?>">
    		<div id="book-cover">
    			<img name="book_cover" style="float:left;" src="<?php echo Yii::app()->request->baseUrl;?>/images/100.png" width="100" height="100">
    			<div class="clear_float"></div>
    		</div>
    		
			<div id="book-detail">
				<div class="input-item">
            		<label for="book_name">书名：</label>
            		<input type="text" name="book[name]" ><a style="float:right;">检查重复</a>
        		</div>
        		
        		<div class="input-item">
            		<label for="book_author">作者：</label>
            		<input type="text" name="book[author]" >
        		</div>
    		
        		<div class="input-item">
            		<label for="publisher">出版社：</label>
            		<input type="text" name="book[publisher]" >
        		</div>
        		
        		<div class="input-item">
            		<label for="publish_time">出版时间：</label>
            		<input type="text" name="book[publish_time]" >
    			</div>
        		
        		<input name="access" type="radio" value="borrow" checked="true">我有可借&nbsp;&nbsp;
        		<input name="access" type="radio" value="sell">我有可卖&nbsp;&nbsp;
        		<input name="access" type="radio" value="private">我在用&nbsp;&nbsp;
        		<input name="access" type="radio" value="havent">我没有&nbsp;&nbsp;
    		
    		</div>
    		<div class="clear_float"></div>
    		<div id="firestcomment">
        		<label for="comment">推荐理由：</label>
        		<div class="clear_float"></div>
        		<div id="content">
        			<textarea name="book[comment]" ></textarea>
        		</div>
    		</div>
			<input type="submit" name="submit" value="确认提交">
    	</form>
		<div class="clear_float"></div>
    </div>
</div>

<div id="content-right">
	<div class="side-box">
		<div class="title">别人为这门课推荐的书籍
			<div class="ihave-book">
        		<div bookid="<?php echo $book['book_id']; ?>" id="ihave"><a>我有此书</a></div>
        		<div id="book-access">
            		<div bookid="<?php echo $book['book_id']; ?>" access="borrow" class="havebook">可借</div>
            		<div bookid="<?php echo $book['book_id']; ?>" access="sell" class="havebook">可卖</div>
            		<div bookid="<?php echo $book['book_id']; ?>" access="private" class="havebook">私有</div>
            	</div>
    		</div>
		</div>
	</div>
</div>