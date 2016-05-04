<?php include('session.php'); ?>
<script>
function daysInMonth(month,year) {
   return new Date(year, month, 0).getDate();
}
function maxDay(which){
var m = document.getElementById(which+'Month');
var month = m.options[m.selectedIndex].value;
var y = document.getElementById(which+'Year');
var year = y.options[y.selectedIndex].value;
var result = daysInMonth(month,year);
 document.getElementById(which+'Day').max = daysInMonth(month,year) || 31;
}
function checkTime(){
var m = document.getElementById("end"+'Month');
var m = document.getElementById("start"+'Month');
var month = m.options[m.selectedIndex].value;
var y = document.getElementById("start"+'Year');
var year = y.options[y.selectedIndex].value;
var day = document.getElementById("start"+'Day').value;

var m = document.getElementById("end"+'Month');
var endMonth = m.options[m.selectedIndex].value;
var y = document.getElementById("end"+'Year');
var endYear = y.options[y.selectedIndex].value;
var endDay = document.getElementById("end"+'Day').value;
var startTime = parseInt(year) + (parseInt(month)/100) + (parseInt(day)/1000);
var endTime = parseInt(endYear) + (parseInt(endMonth)/100) + (parseInt(endDay)/1000);
var q1 = document.getElementById("quality");
var quality = q1.options[q1.selectedIndex].value;
var q2 = document.getElementById("quantity");
var quantity = q2.options[q2.selectedIndex].value;
var val =document.getElementById('validity');
if(quantity[0]=="P" || quality[0]=="P"){
window.alert("Please Select Both Quality and Quantity");
val.value = false;
}else{
if(typeof endTime == "number" && typeof startTime == "number" && (endTime - startTime) > 0){
val.value = true;
}else{
window.alert("Invalid Date");
val.value = false;};
}
}
function setDefaults(){
if(<?php echo '"'.$_SESSION['preQuality'].'"';?> != ""){
 var element = document.getElementById('quality');
element.value = <?php echo '"'.$_SESSION['preQuality'].'"';?>;
element = document.getElementById('quantity');
element.value = <?php echo '"'.$_SESSION['preQuantity'].'"';?>;
element = document.getElementById('startDay');
element.value = <?php echo '"'.$_SESSION['preStartDay'].'"';?>;
element = document.getElementById('startMonth');
element.value = <?php echo '"'.$_SESSION['preStartMonth'].'"';?>;
element = document.getElementById('startYear');
element.value = <?php echo '"'.$_SESSION['preStartYear'].'"';?>;
element = document.getElementById('endDay');
element.value = <?php echo '"'.$_SESSION['preEndDay'].'"';?>;
element = document.getElementById('endMonth');
element.value = <?php echo '"'.$_SESSION['preEndMonth'].'"';?>;
element = document.getElementById('endYear');
element.value = <?php echo '"'.$_SESSION['preEndYear'].'"';?>;
}
}

</script>
<form action="store.php" method="post">
<select class="quality" id="quality" name="quality" >
			<option selected disabled>Please Select a Quality</option>
      <option id ="Super Special Chamber" value="Super Special Chamber">Super Special Chamber</option>
      <option id ="Business Class Room" value="Business Class Room">Business Class Room</option>
      <option id ="Economy Class Room" value="Economy Class Room">Economy Class Room</option>
    </select>
<select class="quantity" id="quantity" name="quantity" >
			<option selected disabled>Please Select a Room Size</option>
      <option id ="single" value="Single">Single</option>
      <option id ="double" value="Double">Double</option>
      <option id ="triple" value="Triple">Triple</option>
      <option id ="quad" value="Quad">Quad</option>
    </select>
<p id="checkIn" class = "description">Check In</p>

<select class="month" id="startMonth" name="startMonth">
			<option selected disabled>Month</option>
      <option value="1">January</option>
      <option value="2">February</option>
      <option value="3">March</option>
      <option value="4">April</option>
      <option value="5">May</option>
      <option value="6">June</option>
      <option value="7">July</option>
      <option value="8">August</option>
      <option value="9">September</option>
      <option value="10">October</option>
      <option value="11">November</option>
      <option value="12">December</option>
    </select>
<input type="number" class="day" id= "startDay" name="startDay" value=1 onclick="maxDay('start')" min="1" max="31">
<select class="year" id="startYear" name="startYear">
      <option value=2016 selected>2016</option>
      <option value=2017>2017</option>
      <option value=2018>2018</option>
    </select>
<p id="checkOut" class = "description">Check Out</p>
<select id="endMonth" class="month" name="endMonth">
			<option selected disabled>Month</option>
      <option value="1">January</option>
      <option value="2">February</option>
      <option value="3">March</option>
      <option value="4">April</option>
      <option value="5">May</option>
      <option value="6">June</option>
      <option value="7">July</option>
      <option value="8">August</option>
      <option value="9">September</option>
      <option value="10">October</option>
      <option value="11">November</option>
      <option value="12">December</option>
    </select>
<input type="number" id= "endDay" class = "day" name="endDay" value=1  onclick="maxDay('end')" min="1" max="31">
<select id="endYear" name="endYear" class="year">
      <option value="2016" selected>2016</option>
      <option value="2017">2017</option>
      <option value="2018">2018</option>
    </select>
<input type="submit" value="Submit Reservation"  onclick="maxDay('start'); maxDay('end'); checkTime();">
<input type="hidden" id="validity" name= "valid" value=false>
</form>
<br>
<br>
<br>
<script>
setDefaults();
</script>
<br>
<?php
if($_SESSION['valid'] == "true"){
echo "<div class='description enjoy'>Enjoy your stay in a " . $_SESSION['quantity'] . " " . $_SESSION['quality']."</div>"; 
}
?>
