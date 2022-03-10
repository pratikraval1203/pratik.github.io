<!DOCTYPE html>
<html>
<head>
	<title>Task 14</title>
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
</head>
<body>
	<div class="container">
		<div class="head">The World Of Fruits</div>
		<div class="main">
			<div class="form-header">Fruit Survey</div>
			<form id="form1" action="third.php" method="get">
				<div class="left-col">
					<label for="name">Name</label>
				</div> <!-- left-col ends -->
				<div class="right-col">
					<input type="text" name="name" id="name">
				</div> <!-- roght-col ends -->
				<div class="clear"></div>
				<div class="left-col">
					<label for="adrs">Address</label> 
				</div> <!-- left-col ends -->
				<div class="right-col">
					<textarea name="address" rows="4" cols="22" id="adrs">
					</textarea>
				</div> <!-- roght-col ends -->
				<div class="clear"></div>
				<div class="left-col">
					<label for="email">Email</label>
				</div> <!-- left-col ends -->
				<div class="right-col">
					<input type="text" name="email" id="email">
				</div> <!-- roght-col ends -->
				<div class="clear"></div>
				<div class="left-col">
					<label>How many pieces of fruits<br>do you eat in a day?</label> 
				</div> <!-- left-col ends -->
				<div class="right-col">
					<input type="radio" name="fruits" id="zero" value="0">
					<label for="zero"> 0</label>
					<br>
					<input type="radio" name="fruits" id="one" value="1">
					<label for="one"> 1</label>
					<br>
					<input type="radio" name="fruits" id="two" value="2">
					<label for="two"> 2</label>
					<br>
					<input type="radio" name="fruits" id="mttwo" value="more than 2">
					<label for="mttwo">more than 2</label>
				</div> <!-- roght-col ends -->
				<div class="clear"></div>
				<div class="left-col">
					<label for="ffruit">My Favourite Fruits</label>
				</div> <!-- left-col ends -->
				<div class="right-col">
					<select name="fav-fruit" id="ffruit" multiple>
						<option>Apple</option>
						<option>Banana</option>
						<option>Plum</option>
						<option>Pomegranate</option>
						<option>Chicku</option>
						<option>Orange</option>
						<option>Grapes</option>
					</select>
				</div> <!-- roght-col ends -->
				<div class="clear"></div>
				<div class="left-col">
					<label for="yes">Would you like a <br> brochure?</label>
				</div> <!-- left-col ends -->
				<div class="right-col">
					<input type="checkbox" name="brochure" id="yes">
				</div> <!-- roght-col ends -->
				<div class="clear"></div>
				<div class="left-col">
					
				</div> <!-- left-col ends -->
				<div class="right-col">
					<input type="submit" name="Register" class="s-btn">
					<input type="reset" name="clear" value="clear" class="r-btn">
				</div> <!-- roght-col ends -->
				<div class="clear"></div>
			</form>
		</div> <!-- main ends -->
		<div class="clear"></div>       
	</div> <!-- container ends -->
</body>
</html>