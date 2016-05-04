<?php
require('session.php');
if(!isset($_SESSION['user_id']))
{
	header('Location: http://recursivehow.com/'); exit; } else {
		try
		{
			require('../hidden/connect_jason.php');
			$stmt = $dbh->prepare("SELECT * FROM requests
				 WHERE whose = :whose");

			$stmt->bindParam(':whose', $_SESSION['username'], PDO::PARAM_STR);

			$stmt->execute();

			$requests = $stmt->fetchAll();
			$_SESSION['requests'] = $requests;
echo '<p class = "description head">Here Are Your Previous Requests<br>Click On Any of Them To Submit Another Similar Request</p>';
if(sizeOf($requests) <1){
echo '<center><form action="level.php" method="post" id="levelForm">
	<button type = "submit" name = "file" class="description request" value="request.php">You have not made any requests yet.<br>To be redirected to the request page click here.</button></form></center>';
}
foreach($requests as $index){
echo '<div class = "description request" onclick="repeat(this)">Room Size: <span id = "quantity">'.$index['quantity']."</span> <br>Room Type: <span id = 'quality'>".$index['quality']."</span><br>Check In: <span id='startMonth'>".$index['startMonth']."</span>/<span id='startDay'>".$index['startDay']."</span>/<span id='startYear'>".$index['startYear']."</span> <br>Check Out: <span id='endMonth'>".$index['endMonth']."</span>/<span id='endDay'>".$index['endDay']."</span>/<span id='endYear'>".$index['endYear']."</span></div>";
echo "\r\n";
}
		}
		catch (Exception $e)
		{
			$message = 'We are unable to process your request. Please try again later"';
		}
	}
?>

<form action="requestSetter.php" method="post" id="postItNote">
<input type="hidden" id="fquality" name= "quality" value="quality"></input>
<input type="hidden" id="fquantity" name= "quantity" value="quantity"></input>
<input type="hidden" id="fstartDay" name= "startDay" value="startDay"></input>
<input type="hidden" id="fstartMonth" name= "startMonth" value="startMonth"></input>
<input type="hidden" id="fstartYear" name= "startYear" value="startYear"></input>
<input type="hidden" id="fendDay" name= "endDay" value="endDay"></input>
<input type="hidden" id="fendMonth" name= "endMonth" value="endMonth"></input>
<input type="hidden" id="fendYear" name= "endYear" value="endYear"></input>
</form>
<script>
function repeat(that){
var names = ["quality", "quantity", "startDay", "startMonth", "startYear", "endDay", "endMonth", "endYear"];
for(var name in names){
document.getElementById("f"+names[name]).value = that.querySelector('#'+names[name]).innerHTML;
}
postForm = document.getElementById("postItNote");
postForm.submit();
}
</script>

