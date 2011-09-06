$(function() {
	$( "#tabs" ).tabs({
		cookie: {
			// store cookie for a day, without, it would be a session cookie
			expires: 1
		}
	});
	//$( "#tabs" ).tabs({ fx: { opacity: 'toggle' } });
	function formatResult(row) {
		return row[0].replace(/(<.+?>)/gi, '');
	}
	$("#teacher").focus().autocomplete(BASE_URL + "/index.php?r=cs/autocomplete/autoteacher", {
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
	$("#course").autocomplete(BASE_URL + "/index.php?r=cs/autocomplete/autocourse", {
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
	$("#book").autocomplete(BASE_URL + "/index.php?r=cs/autocomplete/autobook", {
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
	
	//现实日历
	$( "#datepicker" ).datepicker();
	$( "#datepicker" ).datepicker("option", "dateFormat", "yy-mm-dd");	
});