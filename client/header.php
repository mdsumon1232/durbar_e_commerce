
<?php
  $profile = isset($_SESSION['user']['user_img']) ? $_SESSION['user']['user_img'] : '../images/user.png' ;
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
				<div class="search-box" id="search_input"> 
					<input type="text" placeholder="search here" >
					<button class="search-btn"> search </button>
			</div>
			<div class="menu" id="menu">
				<ul> 
					<li> <a href="index.html"> Home </a> </li>
					<li> <a href=""> Ordered </a> </li>
					<li> <a href=""> Cart </a> </li>
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