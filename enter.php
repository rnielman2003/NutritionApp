<!--<?php
error_reporting(E_ALL);
require_once 'classes/check.php';
$membership = New Membership();
$membership->confirm_Member();
require_once 'classes/insert.php';
$insert = New InsertRecords();

//determine day
if($_GET['d']) {
	$the_day = $_GET['d'];
	} else {
	$the_day = '1';
}

// did they submit
if($_POST && !empty($_POST['theId'])) {
	session_start();
	$userid  = $_SESSION['id'];

	$n=0;
	foreach ($_POST['theId'] as $thing) {
		   $bigarray[$n][1] = $thing;
		   $n++;
	}
	$n=0;
	foreach ($_POST['theAmt'] as $thing) {
		   $bigarray[$n][2] = $thing;
		   $n++;
	}
	foreach ($bigarray as $part) {
		   $response = $insert->insert_Items(NULL, $userid, $part[1], $part[2], $the_day); 
	}

}

// btn message
if ($the_day == '1') {
	$btn_msg = 'Save &raquo; Go To Day 2';
} else if($the_day == '2') {
	$btn_msg = 'Save &raquo; Go To Day 3';
} else {
	$btn_msg = 'Finish';
}
?>
<!DOCTYPE html>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Precision nutrition</title>

<!-- <script type="text/javascript" src="js/jquery-1.2.1.pack.js"></script> -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("get_food.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} // lookup
	
	function fill(shortname,id,amount) {
		var i = $('tr').size();

		if (i == 0) {
			$('table.list').prepend('<tr><th>Title</th><th>Amount</th><th>&nbsp;</th></tr>');
			$(".button").css("display", "block");
			
		}
		$('table.list').append('<tr><td>'+shortname+'</td><td><input type="hidden" name="theId[]" value="'+id+'"><input type="text" name="theAmt[]" value="'+amount+'"></td><td><a href="#" class="remove"><img src="images/delete.gif"></a></td></tr>');
        
        console.log("ADD:"+i);
		setTimeout("$('#suggestions').hide();", 500);
		$('#inputString').val('');
		
	}
		

		
	
	
$(document).ready(function(){
  $("a.remove").live("click", function(){
    $(this).closest('tr').remove();
	var i = $('tr').size();
	console.log("REM:"+i);
	if (i == 1) {
		$('table.list tr:first').remove();
		$(".button").css("display", "none");
	}
  });

});
	
</script>
<link rel="stylesheet" type="text/css" href="css/styles.css" />


</head>

<body>
<div class="top_line">
	<ul class="left">
		<li<? if ($the_day == '1') {echo ' class="on"';}?>>Day 1</li>
		<li<? if ($the_day == '2') {echo ' class="on"';}?>>Day 2</li>
		<li<? if ($the_day == '3') {echo ' class="on"';}?>>Day 3</li>
		<li<? if ($the_day == 'fin') {echo ' class="on"';}?>>Done</li>
	</ul>
	<a href="login.php?status=loggedout">Log Out</a>
</div>
<div id="main">
		<form>
			<div>
			<h1><? if ($the_day == '1') {echo 'Day 1:';} else if ($the_day == '2') {echo 'Day 2:';} else if ($the_day == '3') {echo 'Day 3:';}?> Dietary Record</h1>
				<? if ($the_day == 'fin') {echo '<p>Your three day dietary plan has been entered. We will be in contact with you shortly.';}
				else { ?>
				<p>It is important that this record be both accurate and representative of your normal dietary intake. 
Thus it is essential that you do not alter your normal eating habits in any way and that you record as 
precisely as possible every single item that you consume (this includes water, vitamins, condiments, 
etc.). To do so, you must follow a few simple instructions (listed below). The purpose here is to 
correctly record and quantify your normal intake, not to judge it. If you change your eating habits in 
any way, then we cannot accurately analyze your typical diet. The procedure may seem somewhat 
cumbersome, but remember, it is only three days.</p>
				<h3>Use the box below to search and add items to your list (start typing in the box to bring up results):</h3>
				<br />
				<input type="text" size="30" value="" id="inputString" onkeyup="lookup(this.value);"  />
			</div>
			
			<div class="suggestionsBox" id="suggestions" style="display: none;">
				
				<ul class="suggestionList" id="autoSuggestionsList">
					&nbsp;
				</ul>
			</div>
            </form>
			<form method="post" action="">
			<table class="list">
				
			</table>
			<input type="submit" value="<? echo $btn_msg; ?>" class="button" style="display:none;">
			</form>
		
			<? } ?>

</div>
</body>
</html>-->
