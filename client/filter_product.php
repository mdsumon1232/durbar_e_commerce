<?php
	require('../database_config/config.php');

?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title> durbar commerce </title>
		<link rel="stylesheet" href="style.css" >
	</head>
	<body>
		<header class="header">
			<nav class="nav">
			<div class ="logo">
				<h1> <a href="index.html"> durbar-commerce </a> </h1> </div>
				<button id="search_btn"> search </button>
				<div class="search-box" id="search_input"> 
					<input type="text" placeholder="search here" >
					<button class="search-btn"> search </button>
			</div>
			<div class="menu" id="menu">
				<ul> 
					<li> <a href="index.html"> Home </a> </li>
					<li> <a href="index.html"> Category </a> </li>
					<li> <a href="index.html"> Ordered </a> </li>
					<li> <a href="index.html"> Cart </a> </li>
				</ul>
			</div>
			<p id="toggle"> menu </p>
		</nav>
		</header>
		 
		<section class="main-section">
			<div class="main-container">
				<div class="left-side">
					<h2> Category </h2>
					<ul> 
						<?php

							$select_category = "SELECT * FROM category";
							$select_query = $conn -> query($select_category);
							if($select_query -> num_rows >0){
								
								
								while($category_data = mysqli_fetch_array($select_query)){
									echo "<li><a href='./filter_product.php?id=$category_data[id]'>$category_data[category]</a></li>";
								}
							}
							else{
								echo "<li> Category Not found </li>";
							}

						?>
					</ul>
				</div>
				<div class="right_side">
                   
					<?php
                     
				if(isset($_GET['id'])){
					$category_id = $_GET['id'];
					$select_product = "SELECT product .* , category.category FROM category INNER JOIN product ON product.category_id = category.id WHERE category_id = '$category_id'";
					$product_query = $conn -> query($select_product);
					if($product_query -> num_rows >0){
					   while($product_data = mysqli_fetch_array($product_query)){
						   echo "
								   <div class='cart'>
								   <img src='$product_data[product_img]' >
								   <h3> $product_data[product_name] </h3>
								   <p> $product_data[product_details] </p>
								   <p> price: $product_data[product_price] $ </p>
								   <p> Brand : $product_data[product_band] </p>
								   <p> Category: $product_data[category] </p>
								   <button class='cart_btn'> Add to cart </button>
								   </div>
							   ";
					   }
					} 
					else {
						   echo "<p> NO product available </p>";
					} 
				}
					

					?>
				   
				   
				</div>

			</div>
		</section>
		 
		<script src="menu.js"> </script>
	</body>
</html>