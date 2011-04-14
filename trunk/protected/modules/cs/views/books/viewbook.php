<?php
$this->breadcrumbs=array(
	'Books'=>array('/cs/books'),
	'Viewbook',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>
<h1>显示书籍详情，在边栏显示书籍相关课程，在底部显示拥有此书籍的Njuer，在此页可以点击标注 ××我有×× </h1>
<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>
<div style="width:500px;float:left;">
	<h2>《<?php echo $book['book_name'];?>》</h2>
	<div>
		 <img style="float:left;" src="<?php echo Yii::app()->request->baseUrl;?>/images/100.png" width="100" height="100">
		 <h5></h5>
		 <div>第一推荐人: <?php echo $book['provider_name'];?></div>
		 <div>封面提供者: <?php echo '华挺';?></div>
		 <div>
		 <?php if($book['comments']){?>
		 还没有人对这本书做评价，沙发吧<br/>还没有人对这本书做评价，沙发吧<br/>还没有人对这本书做评价，沙发吧<br/>还没有人对这本书做评价，沙发吧<br/>
		 <?php }else{?>
		 <div class="clear_float"></div>
		 <div>
		 	<p>
		 	这本书不错，但是不适合初学人士。这本书不错，但是不适合初学人士。这本书不错，但是不适合初学人士。这本书不错，但是不适合初学人士。
		 	这本书不错，但是不适合初学人士。这本书不错，但是不适合初学人士。这本书不错，但是不适合初学人士。
		 	</p>
		 	<p>
		 	这本书不错，但是不适合初学人士。这本书不错，但是不适合初学人士。这本书不错，但是不适合初学人士。这本书不错，但是不适合初学人士。
		 	这本书不错，但是不适合初学人士。这本书不错，但是不适合初学人士。这本书不错，但是不适合初学人士。
		 	</p>
		 	<p>评论者：评论者1；评论时间：2011-04-13 20:59  评价者院系：软件学院</p>
		 </div>
		 <div class="clear_float"></div>
		 <h3>&nbsp;</h3>
		 <div>
		 	<p>
		 	这本书不错，但是不适合初学人士。这本书不错，但是不适合初学人士。这本书不错，但是不适合初学人士。这本书不错，但是不适合初学人士。
		 	这本书不错，但是不适合初学人士。这本书不错，但是不适合初学人士。这本书不错，但是不适合初学人士。
		 	</p>
		 	<p>评论者：评论者1；评论时间：2011-04-13 20:59    评价者院系：软件学院</p>
		 </div>
		 <?php }?>
		 </div>
	</div>
</div>

<div style="float:right;width:300px;">
	<div style="background:#ddd;">
    	<h1>和此书相关的NJU课程有</h1>
    	<div>
    	<a href="#">南大的某一门课</a>
    	</div>
    	<div>
    	<a href="#">南大的某一门课</a>
    	</div>
    	<div>
    	<a href="#">南大的某一门课</a>
    	</div>
    	<div>
    	<a href="#">南大的某一门课</a>
    	</div>
    	<div>
    	<a href="#">南大的某一门课</a>
    	</div>
	</div>
	<div style="background:#ddd;margin-top:20px;">
    	<h1>下面这些Njuer有这本书</h1>
    	<div style="float:left;margin:5px;" >
    		 <img style="float:left;" src="<?php echo Yii::app()->request->baseUrl;?>/images/100.png" width="50" height="50">
    	</div>
    	<div style="float:left;margin:5px;" >
    		 <img style="float:left;" src="<?php echo Yii::app()->request->baseUrl;?>/images/100.png" width="50" height="50">
    	</div>
    	<div style="float:left;margin:5px;" >
    		 <img style="float:left;" src="<?php echo Yii::app()->request->baseUrl;?>/images/100.png" width="50" height="50">
    	</div>
    	<div style="float:left;margin:5px;" >
    		 <img style="float:left;" src="<?php echo Yii::app()->request->baseUrl;?>/images/100.png" width="50" height="50">
    	</div>
    	<div style="float:left;margin:5px;" >
    		 <img style="float:left;" src="<?php echo Yii::app()->request->baseUrl;?>/images/100.png" width="50" height="50">
    	</div>
    	<div style="float:left;margin:5px;" >
    		 <img style="float:left;" src="<?php echo Yii::app()->request->baseUrl;?>/images/100.png" width="50" height="50">
    	</div>
    	<div style="float:left;margin:5px;" >
    		 <img style="float:left;" src="<?php echo Yii::app()->request->baseUrl;?>/images/100.png" width="50" height="50">
    	</div>
    	<div style="float:left;margin:5px;" >
    		 <img style="float:left;" src="<?php echo Yii::app()->request->baseUrl;?>/images/100.png" width="50" height="50">
    	</div>
	</div>
	
</div>
