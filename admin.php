<?php
require_once 'classes/check.php';
$membership = New Membership();
$membership->confirm_Admin();
require_once 'classes/administrator.php';
$administrator = New Admin_tasks();



?>
<!DOCTYPE html>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Precision nutrition</title>


<link rel="stylesheet" type="text/css" href="css/styles.css" />


</head>

<body>

<div class="top_line"><a href="login.php?status=loggedout">Log Out</a></div>
<div id="main">
<div class="adminMain">

			<h1>View Clients</h1>
				<ul class="clients">
					<?php $response = $administrator->user_List(); ?>
				</ul>
				
				<br />
				
		
	
</div>
</div>
</body>
</html>
