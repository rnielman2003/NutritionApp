<?php
session_start();
require_once 'classes/check.php';
$membership = new Membership();


// Did the user enter fields?
if($_POST && !empty($_POST['username']) && !empty($_POST['pwd']) && !empty($_POST['firstname']) && !empty($_POST['lastname'])) {
	$response = $membership->create_User($_POST['username'], $_POST['pwd'], $_POST['firstname'], $_POST['lastname']);
}
													
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register</title>
<link rel="stylesheet" type="text/css" href="css/styles.css" />

</head>

<body>
<div class="top_line"><a href="login.php">Login</a></div>
<div id="main" style="overflow:hidden;">
	<form method="post" action="">
    	<h1>Register</h1>
        <table class="login_form">
			<tr>
				<td><label for="name">Username: </label></td>
				<td><input type="text" name="username" /></td>
			</tr>
			<tr>
				<td><label for="name">Password: </label></td>
				<td><input type="password" name="pwd" /></td>
			</tr>
			<tr>
				<td><label for="name">Firstname: </label></td>
				<td><input type="text" name="firstname" /></td>
			</tr>
			<tr>
				<td><label for="name">Lastname: </label></td>
				<td><input type="text" name="lastname" /></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" value="Submit" name="submit" class="button" /></td>
			</tr>
		</table><br/><br/>
		
		
    </form>
	
    <?php if(isset($response)) echo "<h4 class='alert'>" . $response . "</h4>"; ?>
</div>
</body>
</html>