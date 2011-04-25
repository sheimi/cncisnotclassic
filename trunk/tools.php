<?php
function var_dump_enhance($e, $depth=0, $parent=null, $key=null) {
	if (! is_array ( $e )) {
		for($i = 0; $i < $depth; $i ++) {
			echo "&nbsp;";
		}
		if($key != null || $key == 0){
			echo "$key => ";
		}
		var_dump ( $e );
		echo "<br/>";
		return;
	} else {
		for($i = 0; $i < $depth; $i ++) {
			echo "&nbsp;";
		}
		if($key)
			echo $key;
		else
			echo $e;
		$depth += 4;
		echo '&nbsp; {';
		foreach ( $e as $key => $value ) {
			for($i = 0; $i < $depth; $i ++) {
				echo "&nbsp;";
			}
			echo "<br/>";
			var_dump_enhance ( $value, $depth, $e, $key);
		}
		for($i = 0; $i < $depth; $i ++) {
			echo "&nbsp;";
		}
		$depth -= 4;
		echo '}<br/>';
	}
}
