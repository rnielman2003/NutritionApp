<?php
error_reporting(E_ALL);
require_once 'classes/check.php';
$membership = New Membership();
$membership->confirm_Admin();
require_once 'classes/administrator.php';
$administrator = New Admin_tasks();

$userId = $_GET['uid'];

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
<p class='note'><a href="admin.php">&laquo; Back to users</a></p>
<div class="adminMain">

			<h1><?php $response = $administrator->getName($userId); ?></h1>
				<img src="images/color_code.gif" height="51" width="146" alt="colorcode"/>
					<?php $response = $administrator->list_user_Menu($userId); ?>
				
				
				<br />
				
		
	
</div>
</div>
</body>
</html>
