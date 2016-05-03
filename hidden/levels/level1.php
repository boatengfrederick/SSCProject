<?php include('session.php'); ?>
<form action="userhome.php" method="post">
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
</script>
<select id="quality" name="quality" >
			<option selected disabled>Please Select a quality</option>
      <option id ="best" value="Super Special Chamber">Super Special Chamber</option>
      <option id ="good" value="Business Class Room">Business Class Room</option>
      <option id ="alright" value="Economy Class Room">Economy Class Room</option>
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
<input type="number" class="day" id= "startDay" name="startDay" onclick="maxDay('start')" min="1" max="31">
<select class="year" id="startYear" name="startYear">
      <option value="2016" selected>2016</option>
      <option value="2017">2017</option>
      <option value="2018">2018</option>
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
<input type="number" id= "endDay" class = "day" name="endDay" onclick="maxDay('end')" min="1" max="31">
<select id="endYear" name="endYear" class="year">
      <option value="2016" selected>2016</option>
      <option value="2017">2017</option>
      <option value="2018">2018</option>
    </select>
<input type="submit" value="Submit Reservation"  onclick="maxDay('start'); maxDay('end')">
</form>
<br>
<br>
<br>
<?php if ($_POST['answer'] == 'yes'): ?>
<?php $_SESSION['correct'] = 'true'; ?>
<?php endif; ?>
