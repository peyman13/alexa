<?php 
	$db_hostname="localhost";
	$db_username='root';
	$db_password='nemidoonam';

	if ($mysql_connect=mysql_connect($db_hostname,$db_username,$db_password)) {
		if ($mysql_selectdb=mysql_select_db('mylibrary')) {
			
		}
	}


 ?>