<?php
$this->breadcrumbs=array(
	'Default',
);
?>

<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>
<h1 style="color:red">此页面是用户登录以后的首页，可以选择作为搜  索首页，
<br/>或者用户个人课程首页（貌似有些山寨tongxiang）</h1>
<script type="text/javascript">
$(function() {
	$( "#tabs" ).tabs();
	function formatItem(row) {
		return row[0] + " (<strong>id: " + row[1] + "</strong>)";
	}
	function formatResult(row) {
		return row[0].replace(/(<.+?>)/gi, '');
	}
	$("#teacher").focus().autocomplete("<?php echo Yii::app()->request->baseUrl.'/index.php?r=cs/autocomplete/autoteacher&'?>", {
		minChars: 1,
		max: 8,
		autoFill: false,
		mustMatch: false,
		matchContains: true,
		scrollHeight: 200,
		formatItem: function(data, i, total) {
			// don't show the current month in the list of values (for whatever reason)
			if ( data[0] == months[new Date().getMonth()] ) 
				return false;
			return data[0];
		}
	});
	$("#course").autocomplete("<?php echo Yii::app()->request->baseUrl.'/index.php?r=cs/autocomplete/autocourse'?>", {
		minChars: 1,
		max: 8,
		autoFill: false,
		mustMatch: false,
		scroll:false,
		matchContains: true,
		scrollHeight: 200,
		formatItem: function(data, i, total) {
			// don't show the current month in the list of values (for whatever reason)
			if ( data[0] == months[new Date().getMonth()] ) 
				return false;
			return data[0];
		}
	});
	
	$("#classroom").autocomplete("/images.php", {
		max: 3,
		highlight: false,
		scroll: false,
		scrollHeight: 400,
		formatItem: function(data, i, n, value) {
			return "<img width=\"40\" height=\"40\" src='/images/" + value + "'/> " + value.split(".")[0];
		},
		formatResult: function(data, value) {
			return value.split(".")[0];
		}
	});
	$("#book").autocomplete("<?php echo Yii::app()->request->baseUrl.'/index.php?r=cs/autocomplete/autobook'?>", {
		max: 3,
		highlight: false,
		scroll: false,
		scrollHeight: 400,
		formatItem: function(data, i, n, value) {
			return "<img width=\"40\" height=\"40\" src='/images/" + value + "'/> " + value.split(".")[0];
		},
		formatResult: function(data, value) {
			return value.split(".")[0];
		}
	});

	
	//bind event process function for search button
	$('#ts_form').ajaxForm({ 
        // dataType identifies the expected content type of the server response 
        dataType:'json', 
        // success identifies the function to invoke when the server response 
        // has been received 
        success:   processJson   //成功时的回调函数，没有括号。过程在后面。
    }); 

    function processJson(){
		alert();
    }
	
});
</script>
<div class="search-box">
<div id="tabs">
	<ul>
		<li><a href="#tabs-teacher">老师</a></li>
		<li><a href="#tabs-course">课程</a></li>
		<li><a href="#tabs-classroom">教室</a></li>
		<li><a href="#tabs-book">课本</a></li>
	</ul>
	<div id="tabs-teacher">
		<form id="ts_form" class="search_form" name="search_form" action="<?php echo Yii::app()->request->baseUrl . '/index.php'; ?>">
			<input type="hidden" name="r" value="cs/search/scoursebteacher">
    		<input class="search-input" name="teacher" id="teacher" type="text" size="20">
    		<input id="ts_button" class="search-botton" type="submit" value="搜  索">
		</form>
	</div>
	<div id="tabs-course">
		<form action="index.php" method="get">
			<input type="hidden" name="r" value="cs/search/scourse">
    		<input class="search-input" name="course" id="course" type="text" size="20">
    		<input id="cs_button" class="search-botton" type="submit" value="搜  索">
		</form>
	</div>
	<div id="tabs-classroom">
		<form action="index.php" method="get">
    		<input class="search-input" name="classroom" id="classroom" type="text" size="20">
    		<input id="cs_button" class="search-botton" type="submit" value="搜  索">
    	</form>
	</div>
	<div id="tabs-book">
		<form action="index.php" method="get">
			<input type="hidden" name="r" value="cs/search/sbook">
    		<input class="search-input" name="book" id="book" type="text" size="20">
    		<input id="bs_button" class="search-botton" type="submit" value="搜  索">
    	</form>
	</div>
</div>
</div><!-- End demo -->