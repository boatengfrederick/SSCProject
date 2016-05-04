<?php require('session.php') ?>
<?php 
if(!isset($_SESSION['user_id']))
{
	header('Location: http://sscproject.com/'); 
	exit; 
}
?>
<html>
<head>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!--Why oh why did I not think to just use javascript session variables sooner?-->
<script src="js/navigation.js"></script>
<script src="js/level.js"></script>
<title>SSC Hotels</title>
<link rel="stylesheet" type="text/css" href="css/navigation.css?version=1.0">
<link rel="stylesheet" type="text/css" href="css/levelContent.css">
<link rel="stylesheet" type="text/css" href="css/form.css?version=1.1">
<link rel="stylesheet" type="text/css" href="css/dropdown.css">
<link rel="stylesheet" type="text/css" href="css/home_bar.css?version=1.0">
</head>

<div class="homeBar homeBarText">SSC Hotels</div>
<div id="home"></div>
<ul class="navigationBar">
<form action="level.php" method="post" id="levelForm">
	<div class="navigationSection"><button type = "submit" name = "file" class="navigationDropdownLink" value="requests.php">History</button></div>
	<div class="navigationSection"><button type = "submit" name = "file" class="navigationDropdownLink" value="request.php">Request</button></div>
	<div class="navigationSection"><button type = "submit" name = "file" class="navigationDropdownLink" value="about.php">About</button></div>
	<div class="navigationSection right"><a class="navigationLink" href="logout.php">Logout</a></div>
</form>
</ul>
<body>
<br>
<h2 class="levelContent"><?php echo $_SESSION['message']; ?></h2>
<div class="levelContent">
	<?php require($_SESSION['file']); ?>
</div>
</body>
</html>
