<?php
	
	session_start();

	if (!isset($_GET['captcha']) || empty($_GET['captcha'])) {
		$_SESSION['secure']= rand('1000','9999');
	}
	else {

		$secure=$_SESSION['secure'];

		$getcaptcha=$_GET['captcha'];

		if (isset($getcaptcha)) {
		
		
		if ($getcaptcha==$secure) {
		
		echo "a match";

	}else{

		echo 'dosent match';
	} 

	}
	
	
}
	

?>

<?php


  ?>

<img src="captcha.php">

<form action="rand.php" method="get">
	
<input type="text" name="captcha" >
<input type="submit" value="submit">

</form>