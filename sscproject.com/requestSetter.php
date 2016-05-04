<?php
require('session.php');
$_SESSION['file']="request.php";
$_SESSION['preQuality'] = $_POST['quality'];
$_SESSION['preQuantity'] = $_POST['quantity'];
$_SESSION['preStartDay'] = $_POST['startDay'];
$_SESSION['preStartMonth'] = $_POST['startMonth'];
$_SESSION['preStartYear'] = $_POST['startYear'];
$_SESSION['preEndDay'] = $_POST['endDay'];
$_SESSION['preEndMonth'] = $_POST['endMonth'];
$_SESSION['preEndYear'] = $_POST['endYear'];
header('Location: userhome.php');
exit;
?>
