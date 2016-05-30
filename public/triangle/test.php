<?php

	$y=1;

	function triangle($y){

		$x=1;
		while($x<=$y){
			echo "*";
			$x++;
		}
		echo "<br>";
		if ($y!=600) {
			triangle(++$y);
		}
		
	}
	triangle($y);


?>