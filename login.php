<?php
session_start();
require_once 'classes/check.php';
$membership = new Membership();

// If the user clicks the "Log Out" link on the index page.
if(isset($_GET['status']) && $_GET['status'] == 'loggedout') {
	$membership->log_User_Out();
}

// Did the user enter a password/username and click submit?
if($_POST && !empty($_POST['username']) && !empty($_POST['pwd'])) {
	$response = $membership->validate_User($_POST['username'], $_POST['pwd']);
}
														

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<link rel="stylesheet" type="text/css" href="css/styles.css" />

</head>

<body>
<div class="top_line"><a href="register.php">Register Now</a></div>
<div id="main">
<?php if($_GET["reg"] == "1") { echo "<p class='note'>Thanks for registering! Now login.</p>"; } ?>
	<form method="post" action="">
    	<h1>Login</h1>
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
				<td colspan="2"><input type="submit" value="Login" name="submit" class="button" /></td>
			</tr>
			
		</table>
		<div class="message">
		<h4>Login Info</h4>
		<p>For admin: u: <strong>admin</strong> p: <strong>admin</strong></p>
		<p>For user: Register!</p>
		</div>
		<br/><br/>
    </form>
	
    <?php if(isset($response)) echo "<h4 class='alert'>" . $response . "</h4>"; ?>
</div>
</body>
</html>