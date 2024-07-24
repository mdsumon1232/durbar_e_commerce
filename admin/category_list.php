<?php
	session_start();
    require('../database_config/config.php');
    $message = "";

	if(empty($_SESSION['admin'])){
		header('location: login.php');
	}
    else{
		if(isset($_POST['add'])){
			$category = $_POST['category'];
			if(isset($category) && !empty($category)){
				$check_all_ready_exit = "SELECT * FROM category WHERE category = '$category'";
				if($conn -> query($check_all_ready_exit) -> num_rows > 0){
					$message ="This category already exit";
				}
				else{
					$insert_category = "INSERT INTO category (category) VALUES ('$category')";
					$insert_query = $conn -> query($insert_category);
					if($insert_query){
						$message ="Category add successful";
					}
					else{
						$message ="Something wrong ! try again";
					}
				}
			}
			else{
				$message = "Input a category";
			}
		}
	}

 
?>

<!DOCTYPE HTML>
<html>
	<head> 
		<title> admin/category update </title>
		<link rel="stylesheet" href="category_list.css">
	</head>
	<body>
		<section class="add_category_container">
			<div class="category_form_container">
				<form action="category_update.php" method="POST"  class="category_form">
				 <div class="form-item">
					<label> Category:  </label>
					<input type="text" name="category" placeholder="category name" id="category_flied">
				 </div>
				 <?php  echo isset($_POST['add']) ? "<p>". $message . "</p>" : ""; ?>
				 <input type="submit" name="add" value="Add category" class="add_btn">
				</form>
			<div>
		</section>
		<section class="category_list">
			<div class = "table-container">
			<?php 
                  if(isset($_GET['delete'])){
					echo "<P> Delete successful </p>";
				  }
				  if(isset($_GET['res'])){
					echo "<p> update successful </p>"
				  }
				?>
				<table>
				<caption>  <h2> category List </h2> </caption>
					<thead>
						<tr>
							<th> Serial No. </th>
							<th> category </th>
							<th> Added Date </th>
							<th colspan="2"> Action </th>
						</tr>
					</thead>
					<tbody>
						<?php   
							
							$select_category_data = "SELECT * FROM category";
							$category_data_query = $conn -> query($select_category_data);
							while($category = mysqli_fetch_array($category_data_query)){
								
							echo "
								<tr>
							<td> $category[id] </td>
							<td> $category[category] </td>
							<td> $category[category_date] </td>
							<td> <a href='category_update.php?id=$category[id]'> Edit </a> </td>
							<td> <a href='category_delete.php?id=$category[id]'> Delete</a> </td>
						</tr> ";
							}
						?>
					</tbody>
				</table>
			</div>
		</section>
	</body>
</html>