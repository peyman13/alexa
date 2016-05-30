<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="login-style.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>
<div id="page-wrapper">
	<div id='form-wrapper'>
		
	<form action= "login.php" method="post">

		<fieldset style="height:180px">
			<legend><span class="lable-text">login:</span></legend>

			<label for="username"><span class="lable-text">username:</span></label>

			<input class="login-fields" type="text" name="user" placeholder="username"><br>

			<label for="password"><span class="lable-text">password:</span></label>

			<input class="login-fields" type="password" name="pass" placeholder="password">

			<button class="btn btn-default" id="submit" value="submit">login</button><br>

			<a href="signup.html" >you dont have any acount?</a>
		</fieldset>
	</form>


	</div>
	</div>

</body>

</html>