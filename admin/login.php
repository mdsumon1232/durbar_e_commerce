<?php
  session_start();

   require('../database_config/config.php');
	$message = "";

    if(isset($_POST['login'])){
		$email = $_POST['email'];
		$password = $_POST['password'];

		if(empty($email) && empty($password)){
			$message = "All flied are required";
		}
		else{
           $select_data_from_db = "SELECT * FROM admin WHERE admin_email = '$email'";
		   $query = $conn -> query($select_data_from_db);
		   if($query -> num_rows > 0){
              $fetch_data = mysqli_fetch_array($query);
			  $password_db = $fetch_data['password'];
			  $password_check = password_verify($password , $password_db );
			  if($password_check){
				$_SESSION['admin'] = $fetch_data;
				header('location: dashbord.php');

			  }
			  else{
				$message = "Invalid password";
			  }
		   }
		   else{
			$message = "email not valid";
		   }
		}
	}

?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title> admin/login </title>
		<link  rel="stylesheet" href="login.css">
	</head>
	 <body>
		<div class="container">
			<form action="login.php" method="POST" name="admin_login" class="login-form">
			          
					  <h2> Admin login </h2>
					  
					<input type="text" name="email" placeholder="Enter your email" class="input_flied">
			        <br> </br>
					<input type="password" name="password" placeholder="Enter your password" class="input_flied">
					<br> </br>
					<?php  echo isset($_POST['login']) ? "<p>".$message. "</p>"  : "" ;?>
					<input type="submit" name="login" value="login" class="submit-btn">
			</form>
		</div>
	 </body>
</html>