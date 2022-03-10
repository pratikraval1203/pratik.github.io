<!DOCTYPE html>
<html>
<head>
	<title>String and Boolean Datatype with var_dump</title>
</head>
<body>
	<h2>var_dump() function</h2>
	<?php
		$vd1 = "Apple";
		$vd2 = 50 ;
		$vd3 = 99.99;
		//var_dump is used to know the datatype of a variable
		var_dump($vd1);
		echo "<br>";
		//var_dump() can accept multiple arguments 
		var_dump($vd2,$vd3);
	?>
	<hr>
	<h2>String Datatype</h2>
	<?php
		$sd1 = "This is a string";
		$sd2 = "Anything <strong>in between double quotes (&quot;&quot;)</strong> is declared as a string";
		echo "$sd1" , "<br>" , "$sd2" , "<br>";
		echo "Let's check the size and datatype of 1st String using var_dump() function." , "<br>";
		var_dump($sd1);
	?>
	<hr>
	<h2>Boolean Datatype</h2>
	<?php
		$bd1 = true;
		$bd2 = false;
		$bd3 = TRUE;
		$bd4 = FALSE;
		echo "The Boolean datatype is used to assign only two values." , "<br>";
		echo "The first one is &quot;TRUE&quot; and the other one is &quot;FALSE&quot;." , "<br>";
		echo "Let's check  datatype and values of boolean variables using var_dump() function." , "<br>";
		var_dump($bd1,$bd2);
		echo "<br>";
		var_dump($bd3,$bd4);					
	?>
</body>
</html>