<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="" method="post">
		<fieldset>
			<legend><h5>تغییر رمز عبور</h5></legend>
			<label for='corrunt_pass'>رمز کنونی:</label>
			<input type="password" name='corrunt_pass' required><br><br>

			<label for='new_pass'>رمز جدید:</label>
			<input type="password" name='new_pass'  style="width:180px" required><br><br>

			<label for='renew_pass'>تکرار رمز:</label>
			<input type="password" name='renew_pass' required><br><br>

			<input type="submit" value="تغییر دادن" style="float:right; margin-right:200px;padding:3px">

		</fieldset>
	</form>

	<?php
	session_start();

	include('dbconnect.php');

	$user_id=$_SESSION['user_id'];
	if (isset($_POST['corrunt_pass']) && isset($_POST['new_pass']) && isset($_POST['renew_pass'])) {
		$corrunt_pass=$_POST['corrunt_pass'];
		$new_pass=$_POST['new_pass'];
		$renew_pass=$_POST['renew_pass'];
	
		$first_query="SELECT `password` FROM `mylibrary`.`users` WHERE `user_id`= '$user_id' ";
		
		$first_query_run=mysql_query($first_query);

		$password_result=mysql_fetch_assoc($first_query_run);

		$pass_result=$password_result['password'];

		
		if($corrunt_pass==$pass_result){

				if ($new_pass == $renew_pass) {
					

				$query="UPDATE `mylibrary`.`users` SET `password` = '$new_pass' WHERE `users`.`user_id` = '$user_id' ";

				if($query_run=mysql_query($query)){
					echo "<br>"."<br>";
					echo "رمز عبور شما با موفقیت تغییر کرد";
				}
			}else{

				echo "رمز عبور جدید و تکرار آن یکسان نمیباشد";

			}

		}else{

			echo "رمز عبور ورودی اشتباه میباشد";

		}

		}


	?>
</body>
</html>