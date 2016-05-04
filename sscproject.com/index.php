<?php require('session.php'); ?>
<html>
<head>
<title>Login</title>
<script src="js/validation.js"></script>
<link rel="stylesheet" type="text/css" href="css/login.css">
<!--<link rel="stylesheet" type="text/css" href="css/background.css">-->
<link rel="stylesheet" type="text/css" href="css/home_bar.css?version=1.0">
</head>
<div class = "homeBar homeBarText">SSC Hotels</div>
<body>
<?php if( !isset( $_SESSION['user_id'] ) ): ?>

<form action="login_submit.php" name="login" method="post" onsubmit="return loginValidation()">
	<div id = "div">

		<center><p style="color:#FF4136"><?php if(isset($_SESSION['login_error_message'])) echo $_SESSION['login_error_message'] ;?></p></center>
		<label for="username">Username</label>
		<input type="text" id="username" name="username" value="" maxlength="20" />

		<label for="password">Password</label>
		<input type="password" id="password" name="password" value="" maxlength="20" />

		<input type="submit" value="Login" />

	</div>
</form>
<center>
<div id = "link"><a href="adduser.php">Create User</a></div>
<!--		<div id = "link"><a href="contact.php">Contact</a></div>
		<div id = "link"><a href="about.php">About</a></div>-->
</center>
<?php else: ?>
<?php header('Location: userhome.php'); exit; ?>

<?php endif; ?>
</body>
</html>
