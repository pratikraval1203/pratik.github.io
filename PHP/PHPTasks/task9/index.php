<!DOCTYPE html>
<html>
<head>
	<title>PHP Task 9</title>
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
	<link rel="stylesheet" type="text/css" href="fonts/fontawesome-free-5.5.0-web/css/all.css">
</head>
<body>
	<div class="container">
		<div class="left-col">
			<h3>My Account Login</h3>
			<form action="#" method="get">
				<label for="l-uname">UserName</label> 
				<br>
				<input type="text" name="UserName" id="uname" class="textbox-l">
				<i class="fas fa-user custome"></i>
				<br>
				<br>
				<label for="l-pswrd">Password</label>
				<br>
				<input type="password" name="password" id="l-pswrd" class="textbox-l">
				<i class="fas fa-lock custome"></i>
				<br>
				<br>
				<input type="submit" name="submit" value="Log in" class="login-btn">
				<div class="fp">
					<a href="#">Forgot password?</a>
				</div>
			</form>
			<fieldset>
				<legend style="text-align: center;">Or Sign In With</legend>
				<div class="twitter-btn">
					<div class="icon"><i class="fab fa-twitter"></i></div>
					<div class="text"> Twitter</div>
				</div> <!-- twitter-btn -->
				<div class="fb-btn">
					<div class="icon"><i class="fab fa-facebook-f"></i></div>
					<div class="text"> Facebook</div>
				</div> <!-- fb-btn ends -->
				<div class="gp-btn">
					<div class="icon"><i class="fab fa-google-plus-g"></i></div>
					<div class="text"> Google+</div>
				</div> <!-- gp-btn ends --> 
			</fieldset>
		</div> <!-- left-col ends -->
		<div class="right-col">
			<h3>Registation</h3>
			<form action="data-receiver.php" method="get">
				<div class="right-col-1">
					<label for="fname">First Name*</label>
				</div> <!-- right-col-1 ends -->
				<div class="right-col-2">
					<input type="text" name="FirstName" id="fname" class="textbox">
				</div> <!-- right-col-2 -->
				<div class="clear"></div>

				<div class="right-col-1">
					<label for="lname">Last Name*</label>
				</div> <!-- right-col-1 ends -->
				<div class="right-col-2">
					<input type="text" name="LastName" id="lname" class="textbox">
				</div> <!-- right-col-2 -->
				<div class="clear"></div>

				<div class="right-col-1">
					<label for="pswrd">Passowrd*</label>
				</div> <!-- right-col-1 ends -->
				<div class="right-col-2">					
					<input type="password" name="password" id="pswrd" class="textbox">
				</div> <!-- right-col-2 -->
				<div class="clear"></div>

				<div class="right-col-1">
					<label for="con-pswrd">Confirm Password*</label>
				</div> <!-- right-col-1 ends -->
				<div class="right-col-2">			
					<input type="password" name="con-password" id="con-pswrd" class="textbox">
				</div> <!-- right-col-2 -->
				<div class="clear"></div>

				<div class="right-col-1">
					<label for="dob">Date of Birth*</label>
				</div> <!-- right-col-1 ends -->
				<div class="right-col-2">
					<input type="text" name="DOB" id="dob" class="textbox">
					<!-- <select name="date">
						<option disabled selected>DD</option>
						<option>01</option>
						<option>02</option>
						<option>03</option>
						<option>04</option>
						<option>05</option>
						<option>06</option>
						<option>07</option>
						<option>08</option>
						<option>09</option>
						<option>10</option>
						<option>11</option>
						<option>12</option>
						<option>13</option>
						<option>14</option>
						<option>15</option>
						<option>16</option>
						<option>17</option>
						<option>18</option>
						<option>19</option>
						<option>20</option>
						<option>21</option>
						<option>22</option>
						<option>23</option>
						<option>24</option>
						<option>25</option>
						<option>26</option>
						<option>27</option>
						<option>28</option>
						<option>29</option>
						<option>30</option>
						<option>31</option>
					</select>
					<select name="month">
						<option disabled selected>MM</option>
						<option>01</option>
						<option>02</option>
						<option>03</option>
						<option>04</option>
						<option>05</option>
						<option>06</option>
						<option>07</option>
						<option>08</option>
						<option>09</option>
						<option>10</option>
						<option>11</option>
						<option>12</option>
					</select>
					<select name="year">
						<option disabled selected>YYYY</option>
						<option>2001</option>
						<option>2002</option>
						<option>2003</option>
						<option>2004</option>
						<option>2005</option>
						<option>2006</option>
						<option>2007</option>
						<option>2008</option>
						<option>2009</option>
						<option>2010</option>
						<option>2011</option>
						<option>2012</option>
						<option>2013</option>
						<option>2014</option>
						<option>2015</option>
						<option>2016</option>
						<option>2017</option>
						<option>2018</option>
					</select> -->
				</div> <!-- right-col-2 -->
				<div class="clear"></div>

				<div class="right-col-1">
					<label>Gender*</label>
				</div> <!-- right-col-1 ends -->
				<div class="right-col-2">
					<input type="radio" name="Gender" id="male" value="Male">
					<label for="male">Male</label>
					<input type="radio" name="Gender" id="female" value="Female">
					<label for="female">Female</label>
				</div> <!-- right-col-2 -->
				<div class="clear"></div>

				<div class="right-col-1">
					<label for="email">E-mail*</label>
				</div> <!-- right-col-1 ends -->
				<div class="right-col-2">
					<input type="text" name="E-mail" id="email" class="textbox">
				</div> <!-- right-col-2 -->
				<div class="clear"></div>

				<div class="right-col-1">
					<label for="Mobile-number">Mobile Number*</label>
				</div> <!-- right-col-1 ends -->
				<div class="right-col-2">	
					<input type="text" name="MobileNumber" id="Mobile-number" class="textbox">
				</div> <!-- right-col-2 -->
				<div class="clear"></div>

				<div class="right-col-1">
					<label for="address">Address*</label>
				</div> <!-- right-col-1 ends -->
				<div class="right-col-2">	
					<textarea name="address" id="address" rows="3" cols="33"></textarea>
				</div> <!-- right-col-2 -->
				<div class="clear"></div>

				<div class="right-col-1">
					<label for="city">City*</label>
				</div> <!-- right-col-1 ends -->
				<div class="right-col-2">	
					<select name="city" id="city" class="textbox">
						<option selected disabled>Select City</option>
						<option>Gandhinagar</option>
						<option>Ahemdabad</option>
						<option>Vadodara</option>
						<option>Surat</option>
						<option>Bhavnagar</option>
						<option>Mehsana</option>
					</select>
				</div> <!-- right-col-2 -->
				<div class="clear"></div>

				<div class="right-col-2">
					<input type="checkbox" name="tncag" id="tnc">
					<label for="tnc">Agree to Terms & Conditions</label>
				</div> <!-- right-col-2 -->
				<div class="clear"></div>

				<div class="right-col-2">
					<input type="reset" name="Reset" class="clr-btn">
					<input type="submit" name="submit" class="reg-btn">
				</div> <!-- right-col-2 ends -->
			</form>
		</div> <!-- right-col ends -->
		<div class="footer">
			By clicking Sign Up, you have read & agree to the www.abc.com <br>
			<a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a>
		</div>
		<div class="clear"></div>
	</div> <!-- container ends -->
	<script type="text/javascript" src="fonts/fontawesome-free-5.5.0-web/js/all.js"></script>
</body>
</html>