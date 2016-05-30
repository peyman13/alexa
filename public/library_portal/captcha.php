<?php
	session_start();

	header('content-type: image/jpeg');

	$text = $_SESSION['secure'];

	$captcha = imagecreate(100, 50);
	
	imagecolorallocate($captcha, 255, 255, 255);
	
	$font =30;

	$text_color = imagecolorallocate($captcha, 0, 0, 0);

	for ($i=0; $i <20 ; $i++) { 
		$x1=rand('0','100');
		$y1=rand('0','100');
		$x2=rand('0','100');
		$y2=rand('0','100');
		imageline($captcha, $x1 , $y1 , $x2, $y2 , $text_color);
	}

	imageline($captcha, 10 , 10 , 30, 30 , $text_color);

	imagettftext($captcha, $font, 0, 0 , 30, $text_color,'AlexBrush-Regular.ttf' , $text);

	imagejpeg($captcha);



?>