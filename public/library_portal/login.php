<?php
session_start();

$mysql_host='localhost';
$mysql_user='root';
$mysql_pass='nemidoonam'; 

mysql_connect($mysql_host , $mysql_user , $mysql_pass);

if (mysql_connect($mysql_host , $mysql_user , $mysql_pass)) {

		mysql_select_db('mylibrary') or die('asd');
		$user=$_POST['user'];
		$pass=$_POST['pass'];
		$query="SELECT `user_id`  FROM `users` WHERE `username`='$user' and `password`='$pass' ";

		if($query_run=mysql_query($query)){

				if (mysql_num_rows($query_run)==1) {

					$user_id=mysql_result($query_run, 0 );

					$_SESSION['user_id']=$user_id;

					
					
					header('Location: main.php');


				}

				else{

					echo "youre username or password is wrong";
				}

			}
			
		}

		

	

	

?>