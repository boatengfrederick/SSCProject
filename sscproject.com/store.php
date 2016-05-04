<?php
require('session.php');

if($_POST['valid'] == "true")
{
$_SESSION['post'] = $_POST;
$_SESSION['valid'] = "true";
	 $_SESSION['quality'] = $quality = $_POST['quality'];
	 $_SESSION['quantity']=$quantity = $_POST['quantity'];
	 $_SESSION['startDay']=$startDay = $_POST['startDay'];
	$_SESSION['startMonth']=$startMonth = $_POST['startMonth'];
	 $_SESSION['startYear']=$startYear = $_POST['startYear'];
	$_SESSION['endDay']   = $endDay = $_POST['endDay'];
	 $_SESSION['endMonth']=$endMonth = $_POST['endMonth'];
	 $_SESSION['endYear'] = $endYear = $_POST['endYear'];
   $whose = $_SESSION['username'];


	try
	{
		require('../hidden/connect_jason.php');

		$stmt = $dbh->prepare("INSERT INTO requests (whose, quality, quantity, startDay, startMonth, startYear, endDay, endMonth, endYear) VALUES (:whose, :quality, :quantity, :startDay, :startMonth, :startYear, :endDay, :endMonth, :endYear)");

		$stmt->bindParam(':whose', $whose, PDO::PARAM_STR);
		$stmt->bindParam(':quality', $quality, PDO::PARAM_STR);
		$stmt->bindParam(':quantity', $quantity, PDO::PARAM_STR);
		$stmt->bindParam(':startDay', $startDay, PDO::PARAM_STR);
		$stmt->bindParam(':startMonth', $startMonth, PDO::PARAM_STR);
		$stmt->bindParam(':startYear', $startYear, PDO::PARAM_STR);
		$stmt->bindParam(':endDay', $endDay, PDO::PARAM_STR);
		$stmt->bindParam(':endMonth', $endMonth, PDO::PARAM_STR);
		$stmt->bindParam(':endYear', $endYear, PDO::PARAM_STR);

		$stmt->execute();

		$_SESSION['request'] = 'New request added';
header('Location: userhome.php');
exit;
	}
	catch(Exception $e)
	{
		if( $e->getCode() == 23000)
		{
			$_SESSION['create_error_message'] = 'Username already exists';
		}
		else
		{
			$_SESSION['create_error_message'] = 'We are unable to process your request. Please try again later"';
		}
	}
}
?>
<?php
header('Location: userhome.php');
exit;
?>
