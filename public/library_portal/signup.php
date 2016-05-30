<?php
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$username=$_POST['username'];
	$password=$_POST['password'];

	$mysql_host='localhost';
	$mysql_user='root';
	$mysql_pass='nemidoonam'; 

	mysql_connect($mysql_host , $mysql_user , $mysql_pass);

	if (mysql_connect($mysql_host , $mysql_user , $mysql_pass)) {

		mysql_select_db('mylibrary') or die('asd');

	}
	/*include('dbconnect.php');*/

	$query="INSERT INTO `mylibrary`.`users` (`user_id`, `first_name`, `last_name`, `username`, `password`) VALUES (NULL, '$firstname', '$lastname', '$username', '$password')";

	if (mysql_query($query)) {
	    header('Location: main.php');

	}




?>