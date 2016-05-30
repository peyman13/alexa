<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="result.css">
	<link rel="stylesheet" type="text/css" href="main.css">
	<link rel="stylesheet" type="text/css" href="font-awesome-4.5.0/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script type="text/javascript" src="jquery.js"></script>

	<script type="text/javascript">
        $(document).ready(function () {
            $("#nav > li > a").on("click", function (e) {
               
                if ($(this).parent().has("ul")) {
                    e.preventDefault();
                }

                if ($(this).hasClass("open") == false) {
                    $("#nav li ul").slideUp(350);
                    $("#nav li a").removeClass("open");

                    $(this).next().slideDown(350);
                    $(this).addClass("open");
                }

                else if ($(this).hasClass("open") == true) {
                    $(this).removeClass("open");
                    $(this).next("ul").slideUp(350);
                }
            });
        });

    </script>

    <script type="text/javascript">

	function test(){

		var x=confirm('مطمئن هستید ک میخواهید خارج شوید؟!');
		if (x == true) {
			document.getElementById('logout').submit();
		}

	}


	</script>
</head>
<body>
	<div id='pagewrapper'>

		<div id="change_pass_content">

		<div id="iconwrapper">
    				<a href="main.php"><i class="fa fa-home fa-3x"></i></a>
    	</div>
			
			<div id="scrollit">

				<form action="" method="post"> 

					<table class="table-responsive table-bordered">

						 <thead>
							<tr>
								<th>عنوان کتاب</th>
								<th>نویسنده / مترجم</th>
								<th>انتشارات</th>
								<th>سال اولین چاپ</th>
								<th>لغو رزرو</th>
							</tr>
						 </thead>	
					<tbody>
					
					<?php 
					session_start();
					$user_id=$_SESSION['user_id'];

					include("dbconnect.php");



					

						$user_id=$_SESSION['user_id'];

					$first_query="SELECT `book_id` FROM `reserved` WHERE `user_id`='$user_id' AND `state` = '1' ";

					$first_query_run=mysql_query($first_query);
					$zebra_count=0;
					while ( $first_query_row=mysql_fetch_assoc($first_query_run)) {
						$query="SELECT * FROM `books` WHERE `book_id`='{$first_query_row['book_id']}' ";
						$query_run=mysql_query($query);
						$query_row=mysql_fetch_assoc($query_run);

						if ($zebra_count%2==0) {
							echo "<tr>";
								echo "<td style='background-color:#6985b5'>".$query_row['title']."</td>";
								echo "<td style='background-color:#6985b5'>".$query_row['author']."</td>";
								echo "<td style='background-color:#6985b5'>".$query_row['publisher']."</td>";
								echo "<td style='background-color:#6985b5'>".$query_row['year']."</td>";
								echo "<td style='background-color:#6985b5'>"."<input style='margin:auto;top:0;bottom:0' type='checkbox' class='reserve' name='checked[]' value='{$query_row["book_id"]}'>"."<td>";
							echo "</tr>";

							$zebra_count++;
						}else{
						echo "<tr>";
							echo "<td>".$query_row['title']."</td>";
							echo "<td>".$query_row['author']."</td>";
							echo "<td>".$query_row['publisher']."</td>";
							echo "<td>".$query_row['year']."</td>";
							echo "<td>"."<input style='margin:auto;top:0;bottom:0' type='checkbox' class='reserve' name='checked[]' value='{$query_row["book_id"]}'>"."<td>";
						echo "</tr>";

						$zebra_count++;
						}	
					}

					

					if(isset($_POST['checked'])){

						foreach ($_POST['checked'] as $selected) {
							$delete_query="UPDATE `mylibrary`.`reserved` SET `state` = '0' WHERE `reserved`.`book_id` = '$selected' ";

							$delete_query_run=mysql_query($delete_query);


						}

						echo "رزروهای انتخابی شما با موفقیت حذف شد";

						header('Location: myreserves.php');

					}

					

					

					
								
					?>
					</tbody>
					</table>
					<input type="submit" value="حذف">
				</form>

			</div>
		</div>


		<div id="sidebar">
			<div id="logo"><img src="images/The Library Logo.jpg" style="width:100%;height:100%"></div>
			<div id='menuwrapper'>
			<ul id="nav">
				
		        <li><a href="#"> <span class='glyphicon glyphicon-cog'></span><h4 style="text-align:center">مدیریت حساب کاربری</h2></a>
		            <ul>
		                <li><a href="change-password.php">تغییر رمز عبور</a></li>
		                <li><form action="logout.php" method="post" id="logout"><a href="#" onclick="test();">خروج از حساب کاربری</a></form></li>
		                
		            </ul>
		        </li>
		        <li><a href="#"><h4 style="text-align:center"><span class='glyphicon glyphicon-tags'></span>مدیریت رزروها</h2></a>
		            <ul>
		                <li><a href="#">رزرو های من</a></li>
		                <li><a href="history.php">تاریخچه رزروها</a></li>
		      
		            </ul>
		        </li>        
		        <li><a href="#"><h4 style="text-align:center"><span class='glyphicon glyphicon-phone-alt'></span>تماس با ما</h2></a>
		             <ul>
		                <li><a href="adress.html">آدرس ها و تلفن ها</a></li>
		                <li><a href="aboutus.html">درباره ما</a></li>
		      
		            </ul>
		            
		        </li> 
		         
   		 	</ul>

    		</div>




		</div>
		
	</div>
</body>
</html>