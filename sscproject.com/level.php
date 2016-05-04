<?php include('session.php') ?>
<?php
	$_SESSION['valid'] =false  ;
	$_SESSION['file'] =$_POST['file']  ;
header('Location: userhome.php');
exit;
?>
