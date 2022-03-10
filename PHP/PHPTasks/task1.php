<!DOCTYPE html>
<html>
<head>
	<title>Task1</title>
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
				<td>Global Variable</td>
				<td>
					<code>
						&lt;&quest;php<br>
						&nbsp;&nbsp;&nbsp;&nbsp;$gv1="Global"; //Global variable1<br>
						&nbsp;&nbsp;&nbsp;&nbsp;$gv2="Variable"; //Global variable2<br>
						&nbsp;&nbsp;&nbsp;&nbsp;echo $gv1," ",$gv2; //printing Global variables globally<br>
						&quest;&gt;
					</code>
				</td>
				<td>
					<?php
						$gv1="Global"; 
						$gv2="Variable"; 
						echo $gv1," ",$gv2;
					?>
				</td>
			</tr>
			<tr>
				<td>2</td>
				<td>Local Variable</td>
				<td>
					<code>
						&lt;&quest;php<br>
						&nbsp;&nbsp;&nbsp;&nbsp;function localvar() { <br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$lv1="Local"; //Local variable1<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$lv2="Variable"; //Local variable2<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo $lv1," ",$lv2; //printing Local variables locally<br>
						&nbsp;&nbsp;&nbsp;&nbsp;} <br>
						&nbsp;&nbsp;&nbsp;&nbsp;localvar(); //Function call<br>
						&quest;&gt;		
					</code>
				</td>
				<td>
					<?php
						function localvar() {
							$lv1="Local";
							$lv2="Variable";
							echo $lv1," ",$lv2;
						}

						localvar();
					?>
				</td>
			</tr>
			<tr>
				<td>3</td>
				<td>$GLOBALS[] associative array</td>
				<td>
					<code>
						&lt;&quest;php<br>
						&nbsp;&nbsp;&nbsp;&nbsp;$a=10; //global scope<br>
						&nbsp;&nbsp;&nbsp;&nbsp;function test() {<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$b=20; //local scope<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$c = $GLOBALS['a'] + $b; //using $GLOBALS[] associative array<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo $GLOBALS['a'],"+",$b,"=",$c;<br>
						&nbsp;&nbsp;&nbsp;&nbsp;}<br>
						&nbsp;&nbsp;&nbsp;&nbsp;test();<br>
						&quest;&gt;
					</code>
				</td>
				<td>
					<?php
						$a= 10; //global scope
						function test() {
							$b=20; //local scope
							$c = $GLOBALS['a'] + $b; //using $GLOBALS[] associative array
							echo $GLOBALS['a'],"+",$b,"=",$c;		
						}
						test();
					?>
				</td>
			</tr>
			<tr>
				<td>4</td>
				<td>Global keyword</td>
				<td>
					<code>
						&lt;&quest;php<br>
						&nbsp;&nbsp;&nbsp;&nbsp;$gvar = 10; //global scope<br>
						&nbsp;&nbsp;&nbsp;&nbsp;$gvar2=20;<br>
						&nbsp;&nbsp;&nbsp;&nbsp;function test2() {<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;global $gvar , $gvar2 ; //using global keyword<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo $gvar , " ", $gvar2;<br>
						&nbsp;&nbsp;&nbsp;&nbsp;}<br>
						&nbsp;&nbsp;&nbsp;&nbsp;test2();<br>
						&quest;&gt;		
					</code>
				</td>
				<td>
					<?php
						$gvar = 10; //global scope
						$gvar2=20;
						function test2() {
							global $gvar , $gvar2 ; //using global keyword
							echo $gvar , " ", $gvar2;
						}
						test2();
					?>
				</td>
			</tr>
			<tr>
				<td>5</td>
				<td>Static keyword</td>
				<td>
					<code>
							&lt;&quest;php<br>
							&nbsp;&nbsp;&nbsp;&nbsp;function test3() {<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;static $count=0;<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo $count ," ";<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$count +=1;<br>
							&nbsp;&nbsp;&nbsp;&nbsp;}<br>
							&nbsp;&nbsp;&nbsp;&nbsp;$i;<br>
							&nbsp;&nbsp;&nbsp;&nbsp;for ($i=0; $i <10 ; $i++) { <br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;test3();<br>
							&nbsp;&nbsp;&nbsp;&nbsp;}<br>
							&quest;&gt;
					</code>
				</td>
				<td>
					<?php
						function test3() {
							static $count=0;
							echo $count ," ";
							$count +=1;
						}
						$i;
						for ($i=0; $i <10 ; $i++) { 
							test3();
						}
					?>
				</td>
			</tr>
		</tbody>
	</table>
</body>
</html>