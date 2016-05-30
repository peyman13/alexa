<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
	<title></title>
	<link rel="stylesheet" type="text/css" href="result.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.">
	<link rel="stylesheet" type="text/css" href="font-awesome-4.5.0/css/font-awesome.css">
	
</head>
<body>
	<div class="table-responsive" style="width:90%;position:relative;top:50px;border:2px solid #AA6239">
		<form action="" method="post" id="form_reserv">
			<table class="table table-bordered">
				
			    <tbody>
			      <tr>
			      	
					<?php 

						echo "به یاد داشته باشید شما فقط مجاز به انتخاب 3 کتاب هستید";

						echo "<br>"."<br>";

						function zamane_sabt() {
								
							

							
							echo "<thead>";
						      echo"<tr>";
						        echo "<th>"."عنوان کتاب"."</th>";
						        echo "<th>"."نویسنده / مترجم"."</th>";
						        echo "<th>"."انتشارات"."</th>";
						        echo "<th>"."سال اولین چاپ"."</th>";
						        echo "<th>"."رزرو"."</th>";
						      echo"</tr>";
						    echo "</thead>";
						    echo "<tbody>";
						    $query_zamane_sabt="SELECT * FROM `books` ORDER BY `zamane_sabt`"; 
						    $query_run_zamane_sabt=mysql_query($query_zamane_sabt);
						    $x=0;
						    	$zebra_counter=0;

							    while ($x < 10) {
							    	$query_row_zamane_sabt=mysql_fetch_assoc($query_run_zamane_sabt);

							    	$query_checkfree="SELECT `state` FROM `reserved` WHERE `book_id`='{$query_row_zamane_sabt['book_id']}' ORDER by `state` DESC";
									$query_checkfree_run=mysql_query($query_checkfree);
									$query_checkfree_row=mysql_fetch_assoc($query_checkfree_run);

							    	if ($zebra_counter%2==0) {
								    	echo "<tr>";
											echo "<td style='background-color:#6985b5'>".$query_row_zamane_sabt['title']."</td>";
											echo "<td style='background-color:#6985b5'>".$query_row_zamane_sabt['author']."</td>";
											echo "<td style='background-color:#6985b5'>".$query_row_zamane_sabt['publisher']."</td>";
											echo "<td style='background-color:#6985b5'>".$query_row_zamane_sabt['year']."</td>";
											if ($query_checkfree_row['state']==1) {
											echo "<td style='background-color:#6985b5'>".'<i class="fa fa-thumbs-down">'.'</i>'."</td>";
										}else{
										echo "<td style='background-color:#6985b5'>"."<i class='fa fa-thumbs-up'>"."</i>"."</td>";}
											echo "<td style='background-color:#6985b5'>"."<input style='margin:auto;top:0;bottom:0' type='checkbox' class='reserve' name='checked[]' value='{$query_row_zamane_sabt["book_id"]}'>"."<td>";
										echo "</tr>";
									}else{
										echo "<td>".$query_row_zamane_sabt['title']."</td>";
											echo "<td>".$query_row_zamane_sabt['author']."</td>";
											echo "<td>".$query_row_zamane_sabt['publisher']."</td>";
											echo "<td>".$query_row_zamane_sabt['year']."</td>";
											if ($query_checkfree_row['state']==1) {
											echo "<td>".'<i class="fa fa-thumbs-down">'.'</i>'."</td>";
										}else{
										echo "<td>"."<i class='fa fa-thumbs-up'>"."</i>"."</td>";}
											echo "<td>"."<input style='margin:auto;top:0;bottom:0' type='checkbox' class='reserve' name='checked[]' value='{$query_row_zamane_sabt["book_id"]}'>"."<td>";
										echo "</tr>";
									}
									$zebra_counter++;
									$x++;
							    }
							echo "</tbody>";



							} 



						session_start();

						if (isset($_POST['text-title'])) {
							$title=$_POST['text-title'];
						}
						if (isset($_POST['text-author'])) {
							$author=$_POST['text-author'];
						}
						if (isset($_POST['text-publisher'])) {
							$publisher=$_POST['text-publisher'];
						}
						if (isset($_POST['text-year'])) {
							$year=$_POST['text-year'];
						}
						

						include('dbconnect.php');


						if (!empty($_POST['text-title']) || !empty($_POST['text-author']) || !empty($_POST['text-publisher']) || !empty($_POST['text-year'])) {
							
						
							$query="SELECT * FROM `books` WHERE `title` LIKE '%".mysql_real_escape_string($title)."%' AND `author` LIKE '%".mysql_real_escape_string($author)."%' AND `publisher` LIKE '%".mysql_real_escape_string($publisher)."%' AND `year` LIKE '%".mysql_real_escape_string($year)."%'" ;

							$query_run=mysql_query($query);

							
							$zebra_counter=0;
							while ($query_row=mysql_fetch_assoc($query_run)) {

								$query_checkfree="SELECT `state` FROM `reserved` WHERE `book_id`='{$query_row['book_id']}' ORDER BY `state` DESC ";
								$query_checkfree_run=mysql_query($query_checkfree);
								$query_checkfree_row=mysql_fetch_assoc($query_checkfree_run);

								if ($zebra_counter%2==0) {
									echo "<tr>";
										echo "<td style='background-color:#6985b5'>".$query_row['title']."</td>";
										echo "<td style='background-color:#6985b5'>".$query_row['author']."</td>";
										echo "<td style='background-color:#6985b5'>".$query_row['publisher']."</td>";
										echo "<td style='background-color:#6985b5'>".$query_row['year']."</td>";
										if ($query_checkfree_row['state']==1) {
											echo "<td style='background-color:#6985b5'>".'<i class="fa fa-thumbs-down">'.'</i>'."</td>";
										}else{
										echo "<td style='background-color:#6985b5'>".'<i class="fa fa-thumbs-up">'.'</i>'."</td>";}
										echo "<td style='background-color:#6985b5'>"."<input style='margin:auto;top:0;bottom:0' type='checkbox' class='reserve' name='checked[]' value='{$query_row["book_id"]}'>"."<td>";
									echo "</tr>";
								}
								else{
								echo "<tr>";
								echo "<td>".$query_row['title']."</td>";
								echo "<td>".$query_row['author']."</td>";
								echo "<td>".$query_row['publisher']."</td>";
								echo "<td>".$query_row['year']."</td>";
								if ($query_checkfree_row['state']==1) {
											echo "<td>".'<i class="fa fa-thumbs-down">'.'</i>'."</td>";
										}else{
										echo "<td>".'<i class="fa fa-thumbs-up">'.'</i>'."</td>";}
								echo "<td>"."<input style='margin:auto;top:0;bottom:0' type='checkbox' class='reserve' name='checked[]' value='{$query_row["book_id"]}'>"."<td>";
								echo "</tr>";
								}
								$zebra_counter++;
							}
							
						}

						

						if(isset($_POST['checked'])){
							$checked_arr = $_POST['checked'];
							$count = count($checked_arr);
							if ($count>3) {
								echo "شما حداکثر میتوانید 3 کتاب رزرو کنید";
							}else{
								$time=time();

								$reserved_time=date('Y-m-d' , $time);

								$bargardandan_date=date('Y-m-d' , strtotime('+1 month'));



								$user_id=$_SESSION['user_id'];

								$under3_query="SELECT `user_id` FROM `reserved` WHERE `user_id` ='$user_id' AND `state` = '1' ";

								if($under3_query_run=mysql_query($under3_query)){

									if (mysql_num_rows($under3_query_run)<3) {
										foreach ($_POST['checked'] as $selected) {
											if($check_free=mysql_query("SELECT `book_id` FROM `reserved` WHERE `book_id`='$selected' AND `state` = '1' ")){
												
												if(mysql_num_rows($check_free)==1) {
													echo 'this book has been selected';

												}
												else{

													
													mysql_query("INSERT INTO `mylibrary`.`reserved` (`user_id`, `book_id`, `reserved_date`, `bargardandan_date`) VALUES ('$user_id', '$selected', '$reserved_time', '$bargardandan_date'); ");
													
													echo "سفارش شما با موفقیت ثبت شد";

													

												}
											}
										}
									}
									else{
										echo "you already choose 3 books";
									}
								}

								zamane_sabt();

								
							}
						
						} elseif (!isset($_POST['text-title']) &&  !isset($_POST['text-author']) && !isset($_POST['text-publisher']) && !isset($_POST['text-year']))
							
						{

							zamane_sabt();
							
						}


						
							
						

						
						
					?>
				   <tr>
				</tbody>

			</table>

			<input type="submit" value="ثبت" class='btn' style="float:right">
		</form>

		


	</div>
</body>
</html>
