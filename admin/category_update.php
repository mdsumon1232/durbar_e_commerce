<?php 
 	require('../database_config/config.php'); 

	 $message = "";

	if(isset($_POST['update'])){
		$category = $_POST['category'];
		$category_id = $_POST['category_id'];
    if(isset($category) &&!empty($category)){
      $update_category = "UPDATE category SET category = '$category' WHERE id = '$category_id' ";
	  $update_query = $conn -> query($update_category);

	  if($update_query){
		header('location:category_list.php?res=update_success');
	  }
	  else{
		$message ="something wrong! try again";
	  }
	}
	else{
		$message = "Input new category";
	}
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Update</title>
	 <link rel="stylesheet" href="category_update.css">
</head>
<body>
<section class="add_category_container">
			<div class="category_form_container">
				<form action="category_update.php" method="POST"  class="category_form">
					<h1>Category Update</h1>
				 
					
					<?php

							 if(isset($_GET['id'])){
								$id = $_GET['id'];
								$select_data = "SELECT * FROM category WHERE id = '$id'";
								$select_query = $conn -> query($select_data);

								if($select_query -> num_rows >0){
								$category_fetch = mysqli_fetch_array($select_query);
								$category_name = $category_fetch['category']; 
								$category_id = $category_fetch['id'];
							echo "<div class='form-item'>";
							echo "
								<label> Category:  </label>
								<input type='text' name='category' value='$category_name' placeholder='category name' id='category_flied'>
								";
							echo " <input value='$category_id' name='category_id' hidden>  "; 
							echo "</div>";
							echo "<input type='submit' name='update' value='Update category' class='add_btn'>";
				}
				else{
					echo "<p> Please! Select valid category for update </p>";
			}
  }

?>
				 
				 <?php  echo isset($_POST['add']) ? "<p>". $message . "</p>" : ""; ?>
				 
				</form>
			<div>
		</section>
</body>
</html>