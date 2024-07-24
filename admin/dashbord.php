<?php
   session_start();
   
   if(empty($_SESSION['admin'])){
	header('location: login.php');
   }

?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title> durbar e-commerce/dashbord </title>
		<link rel="stylesheet" href="dashbord.css">
	</head>
	<body>
		 <header class="header">
			<nav class="nav-bar">
				<div class="logo">
					<h1><a href="dashbord.php"> Durbar e-commerce </a></h1>
				</div>
				<div class="menu">
					<ul>
						<li><a href="dashbord.php"> dashbord </a></li>
						<li><a href="">category Update</a></li>
						<li><a href="">Product update</a></li>
						<li><a href=""> category List </a></li>
						<li><a href=""> Product List </a></li>
						<li><a href=""> Ordered </a><li>
					</ul>
				</div>
			</nav>
		</header>
		<section class="main-section">
			<div class="card-groput">
				<div class="card">
					<div class="card-box">
						<h3> Total category </h3>
						<p>0</p>
					</div>
				</div>
				<div class="card">
					<div class="card-box">
						<h3> Total Product </h3>
						<p> 0 </p>
					</div>
				</div>
				<div class="card">
					<div class="card-box">
						<h3> Total Ordered </h3>
						<p> 0 </p>
					</div>
				</div>
				<div class="card">
					<div class="card-box">
						<h3> Total User </h3>
						<p> 0 </p>
					</div>
				</div>
			</div>
		</section>
	</body>
</html>