<!DOCTYPE html>
<html>
<head>
	<title>PHP Task6</title>
</head>
<body>
	<table border="1" cellpadding="10">
		<thead>
			<tr>
				<th>Sr</th>
				<th>Topic Name</th>
				<th>PHP Code</th>
				<th>Output</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>1</td>
				<td>Switch Statement</td>
				<td>
					<code>
						&lt;&quest;php<br>
						&nbsp;&nbsp;&nbsp;&nbsp;$a = 1;<br>
						&nbsp;&nbsp;&nbsp;&nbsp;switch ($a) {<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;case "1":<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo "case 1";<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;break;<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;case 2;<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo "case 2";<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;break;<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;default:<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo "default case executed";<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;break;<br>
						&nbsp;&nbsp;&nbsp;&nbsp;}<br>
						&quest;&gt;
					</code>
				</td>
				<td>
					<?php
						$a = 1;
						switch ($a) {
							case "1":
								echo "case 1";
								break;
							case 2;
								echo "case 2";
								break;
							default:
								echo "default case executed";
								break;
						}
					?>
				</td>
			</tr>
			<tr>
				<td>2</td>
				<td>Switch - If Comparision</td>
				<td>
					<code>
						&lt;&quest;php<br>
						&nbsp;&nbsp;&nbsp;&nbsp;$i = 2;<br>
						&nbsp;&nbsp;&nbsp;&nbsp;if ($i == 0) {<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo "i equals 0";<br>
						&nbsp;&nbsp;&nbsp;&nbsp;} elseif ($i == 1) {<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo "i equals 1";<br>
						&nbsp;&nbsp;&nbsp;&nbsp;} elseif ($i == 2) {<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo "i equals 2";<br>
						&nbsp;&nbsp;&nbsp;&nbsp;}<br>
						&nbsp;&nbsp;&nbsp;&nbsp;echo "&lt;br&gt;";<br>
						&nbsp;&nbsp;&nbsp;&nbsp;switch ($i) {<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;case 0:<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo "i equals 0";<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;break;<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;case 1:<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo "i equals 1";<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;break;<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;case 2:<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo "i equals 2";<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;break;<br>
						&nbsp;&nbsp;&nbsp;&nbsp;}<br>
						&quest;&gt;
					</code>
				</td>
				<td>
					<?php
						$i = 2;
						if ($i == 0) {
							echo "i equals 0";
						} elseif ($i == 1) {
							echo "i equals 1";
						} elseif ($i == 2) {
							echo "i equals 2";
						}
						echo "<br>";
						switch ($i) {
							case 0:
								echo "i equals 0";
								break;
							case 1:
								echo "i equals 1";
								break;
							case 2:
								echo "i equals 2";
								break;
						}
					?>
				</td>
			</tr>
		</tbody>
	</table>
</body>
</html>