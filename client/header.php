
<?php
  $profile = isset($_SESSION['user']['user_img']) ? $_SESSION['user']['user_img'] : '../images/user.png' ;


  if(isset($_POST['search_btn'])){
    $search = $_POST['search_text'];
     header("location:search_product.php?search=" .$search);
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="header.css">
</head>
<body>
<header class="header">
			<nav class="nav">
			<div class ="logo">
				<h1> <a href="index.php"> durbar-commerce </a> </h1> </div>
				<button id="search_btn"> search </button>
				<form class="search-box" action="header.php" method="POST" id="search_input"> 
					<input type="text" name="search_text" placeholder="search here" >
					<button type="submit" name="search_btn" class="search-btn"> search </button>
			</form>
			<div class="menu" id="menu">
				<ul> 
					<li> <a href="index.php"> Home </a> </li>
					<li> <a href="ordered.php"> Ordered </a> </li>
					<li> <a href="cart.php"> Cart </a> </li>
                    <?php
                     if(isset($_SESSION['user'])){
                        echo "
                                <li> <img src='".$profile."' class='profile'> 
                                <ul class='drop-down'> 
                                    <li> <a href='user_profile.php'> profile </a> </li>
                                      <li><a href='log_out.php'>Log out</a></li>    
                                 </ul>
                               </li>
                               
                            ";
                     }
                     else{
                        echo "
                             <li><a href='login.php'> Login </a></li>
                             <li><a href=''>Sign Up</a></li>    
                            ";
                     }
                    ?>
				</ul>
			</div>
			<p id="toggle"> <img src="../images/bars.png" alt=""> </p>
		</nav>
		</header>

        <script src="./menu.js"></script>
</body>
</html>