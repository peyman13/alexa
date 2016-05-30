<!DOCTYPE html>
<html>
<head>
	<title></title>
	 <meta charset="UTF-8">

	<link rel="stylesheet" type="text/css" href="signup-style.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>

<div id="page-wrapper">
	
	<div id="form-wrapper">
		
		<form action="http://igib.dev/ramin/signup.php" method="post">
			
			<fieldset style="display:block ; width:300px">
				
				<legend class="lable">personal info</legend>
					<label for="firstname" style="display:inline"><span class="lable">firt name:<span></label>
					<input class="input" type="text" name="firstname" ><br><br>

					<label for="lastname"><span class="lable">last name:<span></label>
					<input class="input" type="text" name="lastname" ><br><br>

					<label for="female"><span class="lable">female<span></label>
					<input type="radio" value="female" name="gender">

					<label for="male"><span class="lable">male<span></label>
					<input type="radio" value="female" name="gender"><br><br>

					<label for="age"><span class="lable">age:<span></label>
					<input class="input" type="text" name="age" maxlength="2"  style="width:50px"><br><br>

					<select>
						<option>
							سیکل
						</option>
						<option>
							دیپلم
						</option>
						<option>
							لیسانس
						</option>
						<option>
							فوق لیسانس
						</option>
						<option>
							دکتری
						</option>
						<option>
							فوق دکتری
						</option>
					</select>

			</fieldset>

			<fieldset style="display:block ; width:300px">
				
				<legend class="lable">user info</legend>
					<label for="username"><span class="lable">username:<span></label>
					<input class="input" type="text" name="username" ><br><br>

					<label for="password"><span class="lable">password:<span></label>
					<input class="input" type="password" name="password"><br><br>

					<label for="confirm"><span class="lable">confirm password:<span></label>
					<input class="input" type="password" name="confirm" ><br><br>

					<label for="tell"><span class="lable">phone number:<span></label>
					<input class="input" type="tel" name="tell" ><br><br>


					<label for="email"><span class="lable">email address:<span></label>
					<input class="input" type="email" name="email" ><br><br>

					<button class="btn btn-default" value="submit" id="submit">submit</button>

			</fieldset>

		</form>
		<?php include('rand.php'); ?>


	</div>

</div>

</body>
</html>