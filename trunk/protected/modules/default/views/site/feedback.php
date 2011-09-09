<div id="feedback" >
	<h1>我在成长中，需要您的建议和批评</h1>
	<div>
		<form method="post">
		<textarea name="content" rows="5" cols="100"></textarea>
		<div class="clear_float"></div>
		<input id="feedback-button" type="submit" value="提交建议">
		</form>
	</div>
	
	<div class="feedbacks" >
		<?php foreach ($feedbacks as $feedback){?>
		<div class="feedback">
			<div class="feedback-content">
			    <?php echo $feedback['content'];?>
			</div>
			<div class='userinfo'>
				<div><?php echo $feedback['username'];?> </div><div><?php echo $feedback['time']?></div>
			</div>
			<div class="clear_float"></div>
		</div>
		<?php }?>
	</div>
	<div class="clear_float"></div>
	<div class="page-nav">
		<?php if($page > 1){?>
			<span class="prev"><a href="index.php?r=default/site/feedback&page=<?php echo $page-1;?>">上一页</a></span>
		<?php }?>
		<?php if ($page < 3){?>
			<?php $upper = $totalPage >= 5?5:$totalPage; ?>
			<?php $i=1; while ($i <= $upper){?>
				<span class=" page <?php if($i==$page) echo 'current-page';?>"><a href="index.php?r=default/site/feedback&page=<?php echo $i;?>"><?php echo $i++;?></a></span>
			<?php }?>
		<?php }else {?>
			<span class="page"><a href="index.php?r=default/site/feedback&page=<?php echo $page - 2;?>"><?php echo $page - 2;?></a></span>
			<span class="page"><a href="index.php?r=default/site/feedback&page=<?php echo $page - 1;?>"><?php echo $page - 1;?></a></span>
			<span class=" page current-page"><a href="index.php?r=default/site/feedback&page=<?php echo $page;?>"><?php echo $page;?></a></span>
			<?php if($page + 1 < $totalPage){?>
				<span class="page"><a href="index.php?r=default/site/feedback&page=<?php echo $page + 1;?>"><?php echo $page + 1;?></a></span>
			<?php }?>
			<?php if($page + 2 < $totalPage){?>
				<span class="page"><a href="index.php?r=default/site/feedback&page=<?php echo $page + 2;?>"><?php echo $page + 2;?></a></span>
			<?php }?>
		<?php }?>
		
		
		<?php if($totalPage > $page){?>
			<span  class="next"><a href="index.php?r=default/site/feedback&page=<?php echo $page + 1;?>">下一页</a></span>
		<?php }?>
		
		<span class="next">(共<?php echo $totalPage;?>页)</span>
	</div>
</div>