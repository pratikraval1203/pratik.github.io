<!DOCTYPE html>
<html>
<head>
	<title>Task 3</title>
</head>
<body>
<table border="1" cellpadding="10">
	<thead>
		<th>Sr</th>
		<th>Output</th>
		<th>Topic Name</th>
		<th>PHP code</th>
	</thead>
	<tbody>
		<tr>
			<td>1</td>
			<td>
				<?php
					$word1 = "Hello PHP";
					echo $word1 , "<br>";
					$word2 = "Hi Students";
					echo $word2 , "<br>";
				?>
			</td>
			<td>String</td>
			<td>
				<code>
					&lt;&quest;php<br>
					&nbsp;&nbsp;&nbsp;&nbsp;$word1 = "Hello PHP";<br>
					&nbsp;&nbsp;&nbsp;&nbsp;echo $word1 , "&lt;br&gt;";<br>
					&nbsp;&nbsp;&nbsp;&nbsp;$word2 = "Hi Students";<br>
					&nbsp;&nbsp;&nbsp;&nbsp;echo $word2 , "&lt;br&gt;";<br>
					&quest;&gt;
				</code>
			</td>
		</tr>
		<tr>
			<td>2</td>
			<td>
				<?php
					$a = 4811;	//decimal Number
					var_dump($a);
					echo "<br>";
					$b = -4811;	//Negative Number
					var_dump($b);
					echo "<br>";
					$c = 0411;	//Octal Number (equivalent to 265 decimal)
					var_dump($c);
					echo "<br>";
					$d = 0x481;	//Hexadecimal Number (equivalent to 1153 deciamal)	
					var_dump($d);
					echo "<br>";
					$e = 2147483647;
					var_dump($e);
					echo "<br>";
					$f = 2147483648; //it will be interpreted as a float
					var_dump($f);
				?>
			</td>
			<td>Integer</td>
			<td>
				<code>
					&lt;&quest;php<br>
					&nbsp;&nbsp;&nbsp;&nbsp;$a = 4811;	//decimal Number<br>
					&nbsp;&nbsp;&nbsp;&nbsp;var_dump($a);<br>
					&nbsp;&nbsp;&nbsp;&nbsp;echo "&lt;br&gt;";<br>
					&nbsp;&nbsp;&nbsp;&nbsp;$b = -4811;	//Negative Number<br>
					&nbsp;&nbsp;&nbsp;&nbsp;var_dump($b);<br>
					&nbsp;&nbsp;&nbsp;&nbsp;echo "&lt;br&gt;";<br>
					&nbsp;&nbsp;&nbsp;&nbsp;$c = 0411;	//Octal Number (equivalent to 265 decimal)<br>
					&nbsp;&nbsp;&nbsp;&nbsp;var_dump($c);<br>
					&nbsp;&nbsp;&nbsp;&nbsp;echo "&lt;br&gt;";<br>
					&nbsp;&nbsp;&nbsp;&nbsp;$d = 0x481;	//Hexadecimal Number (equivalent to 1153 deciamal)<br>
					&nbsp;&nbsp;&nbsp;&nbsp;var_dump($d);<br>
					&nbsp;&nbsp;&nbsp;&nbsp;echo "&lt;br&gt;";<br>
					&nbsp;&nbsp;&nbsp;&nbsp;$e = 2147483647;<br>
					&nbsp;&nbsp;&nbsp;&nbsp;var_dump($e);<br>
					&nbsp;&nbsp;&nbsp;&nbsp;echo "&lt;br&gt;";<br>
					&nbsp;&nbsp;&nbsp;&nbsp;$f = 2147483648; //it will be interpreted as a float<br>
					&nbsp;&nbsp;&nbsp;&nbsp;var_dump($f);<br>
					&quest;&gt;
				</code>
			</td>
			
		</tr>
		<tr>
			<td>3</td>
			<td>
				<?php
					$p = 4.811;
					var_dump($p);
					echo "<br>";
					$q = 4.8e3;
					var_dump($q);
					echo "<br>";
					$r = 4.8E-3;
					var_dump($r);
				?>
			</td>
			<td>Float</td>
			<td>
				<code>
					&lt;&quest;php<br>
					&nbsp;&nbsp;&nbsp;&nbsp;$p = 4.811;<br>
					&nbsp;&nbsp;&nbsp;&nbsp;var_dump($p);<br>
					&nbsp;&nbsp;&nbsp;&nbsp;echo "&lt;br&gt;";<br>
					&nbsp;&nbsp;&nbsp;&nbsp;$q = 4.8e3;<br>
					&nbsp;&nbsp;&nbsp;&nbsp;var_dump($q);<br>
					&nbsp;&nbsp;&nbsp;&nbsp;echo "&lt;br&gt;";<br>
					&nbsp;&nbsp;&nbsp;&nbsp;$r = 4.8E-3;<br>
					&nbsp;&nbsp;&nbsp;&nbsp;var_dump($r);<br>
					&quest;&gt;
				</code>
			</td>
			
		</tr>
		<tr>
			<td>4</td>
			<td>
				<?php
					$m = TRUE;
					var_dump($m);
					$n = false;
					var_dump($n);
				?>
			</td>
			<td>Boolean</td>
			<td>
				<code>
					&lt;&quest;php<br>
					&nbsp;&nbsp;&nbsp;&nbsp;$m = TRUE;<br>
					&nbsp;&nbsp;&nbsp;&nbsp;var_dump($m);<br>
					&nbsp;&nbsp;&nbsp;&nbsp;$n = false;<br>
					&nbsp;&nbsp;&nbsp;&nbsp;var_dump($n);<br>
					&quest;&gt;
				</code>
			</td>
			
		</tr>
		<tr>
			<td>5</td>
			<td>
				<?php
					$c = NULL;
					var_dump($c);
					$d;
					var_dump($d);
				?>
			</td>
			<td>NULL</td>
			<td>
				<code>
					&lt;&quest;php<br>
					&nbsp;&nbsp;&nbsp;&nbsp;$c = NULL;<br>
					&nbsp;&nbsp;&nbsp;&nbsp;var_dump($c);<br>
					&nbsp;&nbsp;&nbsp;&nbsp;$d;<br>
					&nbsp;&nbsp;&nbsp;&nbsp;var_dump($d);<br>
					&quest;&gt;
				</code>
			</td>
		</tr>
	</tbody>
</table>
</body>
</html>