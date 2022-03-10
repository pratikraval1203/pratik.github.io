<!DOCTYPE html>
<html>
<head>
	<title>Data Receiver Page</title>
</head>
<body> 
	<table border="1" cellpadding="10px" cellspacing="5px">
		<thead>
			<tr>
				<th>Name</th>
				<th>Data</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>First Name</td>
				<td>
					<?php
						echo $_GET["FirstName"];
					?>
				</td>
			</tr>
			<tr>
				<td>Last Name</td>
				<td>
					<?php
						echo $_GET["LastName"];
					?>
				</td>
			</tr>
			<tr>
				<td>Password</td>
				<td>
					<?php
						echo $_GET["password"];
					?>
				</td>
			</tr>
			<tr>
				<td>Confirm Password</td>
				<td>
					<?php
						echo $_GET["con-password"];
					?>
				</td>
			</tr>
			<tr>
				<td>Date Of Birth</td>
				<td>
					<?php
						echo $_GET["DOB"];
					?>
				</td>
			</tr>
			<tr>
				<td>Gender</td>
				<td>
					<?php
						echo $_GET["Gender"];
					?>
				</td>
			</tr>
			<tr>
				<td>E-mail</td>
				<td>
					<?php
						echo $_GET["E-mail"];
					?>
				</td>
			</tr>
			<tr>
				<td>Mobile Number</td>
				<td>
					<?php
						echo $_GET["MobileNumber"];
					?>
				</td>
			</tr>
			<tr>
				<td>Address</td>
				<td>
					<?php
						echo $_GET["address"];
					?>
				</td>
			</tr>
			<tr>
				<td>City</td>
				<td>
					<?php
						echo $_GET["city"];
					?>
				</td>
			</tr>
			<tr>
				<td>Agree to T&C</td>
				<td>
					<?php
						echo $_GET["tncag"];
					?>
				</td>
			</tr>
		</tbody>
	</table>
</body>
</html>