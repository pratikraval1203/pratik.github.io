<!DOCTYPE html>
<html>
<head>
	<title>Lect2PHP</title>
	<!-- <br>
	<br>
	<?php

	?> -->
</head>
<body>
	<h2>echo statement</h2>
	<?php
		echo "echo statement using <b>double inverted comma(&quot;...&quot;)</b>";
	?>
	<br>
	<br>
	<?php
			echo 'echo statement using <b>single inverted comma(&#39;...&#39;)</b>';
	?>
	<br>
	<br>
	<?php
		echo "echo statement using <b>double inverted comma(&quot;...&quot;) and parantheses()</b>";
	?>
	<br>
	<br>
	<?php
		echo "echo statement using <b>single inverted comma(&#39;...&#39;) and parantheses()</b>";
	?>
	<br>
	<br>
	<?php
		$a="Pratik Raval"; $b=102; $c=9.28; 
		echo "I'm using echo statement to display <b>values</b> of a,b,c varibles in a single line using <b>statement sepretor(,)</b>---->";
		echo " $a "," $b "," $c ";
	?>
	<br>
	<br>
	<?php
		echo "I'm using echo statement to display <b>names</b> of a,b,c varibles in a single line using <b>statement sepretor(,)</b>---->";
		echo '$a','$b','$c';
	?>
	<h2>print statement</h2>
	<?php
		print "print statement using <b>double inverted comma(&quot;...&quot;)</b>";
	?>
	<br>
	<br>
	<?php
		print 'print statement using <b>single inverted comma(&#39;...&#39;)</b>';
	?>
	<br>
	<br>
	<?php
		print ("print statement using <b>double inverted comma(&quot;...&quot;) and parantheses()</b>");
	?>
	<br>
	<br>
	<?php
		print ('print statement using <b>single inverted comma(&#39;...&#39;) and parantheses()</b>');
	?>
	<br>
	<br>
	<?php
		$a="Pratik Raval"; $b=102; $c=9.28; 
		print "I'm using print statement to display values of a,b,c varibles in a single line using <b>concatenation opretor(.)</b>---->";
		print " $a "." $b "." $c ";
	?>
	<br>
	<br>
	<?php
		print "I'm using print statement to display <b>names</b> of a,b,c varibles in a single line using <b>concatenation opretor(.)</b>---->";
		print '$a'.'$b'.'$c';
	?>
</body>
</html>
