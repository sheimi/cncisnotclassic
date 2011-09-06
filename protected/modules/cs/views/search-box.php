<div class="search-box">
        <div id="tabs">
        	<ul>
        		<li><a href="#tabs-course">课程</a></li>
        		<li><a href="#tabs-teacher">老师</a></li>
        		<li><a href="#tabs-classroom">教室</a></li>
        		<li><a href="#tabs-book">课本</a></li>
        	</ul>
        	<div id="tabs-course">
        		<form action="index.php" method="get">
        			<input type="hidden" name="r" value="cs/search/scourse">
            		<input class="search-input" name="course" id="course" type="text" size="20" value="<?php echo $q;?>">
            		<input id="cs_button" class="search-botton" type="submit" value="搜  索">
        		</form>
        	</div>
        	<div id="tabs-teacher">
        		<form id="ts_form" class="search_form" name="search_form" action="<?php echo Yii::app()->request->baseUrl . '/index.php'; ?>">
    			<input type="hidden" name="r" value="cs/search/scoursebteacher">
        		<input class="search-input" name="teacher" id="teacher" type="text" size="20" value="<?php echo $q;?>">
        		<input id="ts_button" class="search-botton" type="submit" value="搜  索">
    		</form>
    	</div>
    	<div id="tabs-classroom">
    		<form action="index.php" method="get">
        		<input class="search-input" name="classroom" id="classroom" type="text" size="20" value="<?php echo $q;?>">
        		<input id="cs_button" class="search-botton" type="submit" value="搜  索">
        	</form>
    	</div>
    	<div id="tabs-book">
    		<form action="index.php" method="get">
    			<input type="hidden" name="r" value="cs/search/sbook">
        		<input class="search-input" name="book" id="book" type="text" size="20" value="<?php echo $q;?>">
        		<input id="bs_button" class="search-botton" type="submit" value="搜  索">
        	</form>
    	</div>
    </div>
</div>