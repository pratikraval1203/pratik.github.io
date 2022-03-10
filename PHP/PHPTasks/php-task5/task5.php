<!DOCTYPE html>
<html>
<head>
	<title>Task 5</title>
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
</head>
<body>
	<table border="1" cellpadding="10px">
		<thead>
			<tr>
				<th>Sr.</th>
				<th>Topic Name</th>
				<th>PHP Code</th>
				<th>Output</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>1</td>
				<td>If..Else Statement</td>
				<td>
					<code>
						&lt;&quest;php<br>
						&nbsp;&nbsp;&nbsp;&nbsp;$a = 40;<br>
						&nbsp;&nbsp;&nbsp;&nbsp;$b = 50;<br>
						&nbsp;&nbsp;&nbsp;&nbsp;if ($a>$b) {<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo "a is bigger than b.";<br>
						&nbsp;&nbsp;&nbsp;&nbsp;}<br>
						&nbsp;&nbsp;&nbsp;&nbsp;else  {<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo "b is bigger than a.";<br>
						&nbsp;&nbsp;&nbsp;&nbsp;}<br>
						&quest;&gt;
					</code>
				</td>
				<td>
					<?php
						$a = 40;
						$b = 50;
						if ($a>$b) {
							echo '<p class="true">a is bigger than b.</p>';
						}
						else  {
							echo '<p class="false">b is bigger than a.</p>';
						}
					?>
				</td>
			</tr>
			<tr>
				<td>2</td>
				<td>If..Else Statement</td>
				<td>
					<code>
						&lt;&quest;php<br>
						&nbsp;&nbsp;&nbsp;&nbsp;if(true) {<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo "This is if block.";<br>
						&nbsp;&nbsp;&nbsp;&nbsp;}<br>
						&nbsp;&nbsp;&nbsp;&nbsp;else {<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo "This is else block.";<br>
						&nbsp;&nbsp;&nbsp;&nbsp;}<br>
						&quest;&gt;
					</code>
				</td>
				<td>
					<?php
						if(true) {
							echo '<p class="true">This is if block.</p>';
						}
						else {
							echo '<p class="false">This is else block.</p>';
						}
					?>
				</td>
			</tr>
		</tbody>
	</table>
</body>
</html>