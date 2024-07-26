<?php
	require('../database_config/config.php');
  
	$message = "";

	if(isset($_POST['upload_product'])){
 		$product_name = $_POST['product_name'];
		$product_code = $_POST['product_code'];
		$band = $_POST['band'];
		$price = $_POST['price'];
		$category =$_POST['category'];
		$product_details = $_POST['product_details'];
		$product_image_name = $_FILES['produce_image']['name'];
		$product_image_tmp_name = $_FILES['produce_image']['tmp_name'];

		if(empty($product_name) || empty($band) || empty($price) || empty($category) || empty($product_details) || empty($product_image_name) || empty($product_code)){
          $message ="All flied are required";
		}
		else{
			if(strlen($product_details) > 300){
				$message = "product details more than 300 character not allow";
			}
			else{
				if(strlen($product_code) > 10 && strlen($product_code) <10 ){
					$message ="product code must be 10 character";
				}
				else{
					$image_folder = "../images/". $product_image_name;
					move_uploaded_file($product_image_tmp_name , $image_folder);
				
						$insert_data = "INSERT INTO product (product_name , product_band ,product_code,	product_price ,category_id,	product_details ,product_img) VALUES ('$product_name' , '$band' , '$product_code' , '$price' , '$category' ,'$product_details' , '$image_folder')";

					$product_query = $conn -> query($insert_data);
					
					if($product_query){
						$message ="Product insert successful";
					}
					else{
						$message ="Something wrong! try again";
					}
					
				}
			}
		}
	}


?>

<!DOCTYPE HTML>
<html>
	<head>
		<title> product upload</title>
		<link rel="stylesheet" href="product_upload.css">
	</head>
	<body>
		<section class="product_add_container">
			
				<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" class="product_update_form">
				
			     <h2> Add product </h2>

				
					<div class="form_item">
					<label> Product Name : </label>
					<input type="text" name="product_name" placeholder="product name">
					</div>
					
					<div class="form_item"> 
						<label> Product Code </label>
						<input type="text" name="product_code" placeholder="product code">
					</div>
					
					<div class="form_item">
						<label> Product Band </label>
						<input type="text" name="band" placeholder="band">
					</div>
					
					<div class="form_item">
						<label> Price </label>
						<input type="number" name="price" placeholder="product price">
					</div>
				
					<div class="form_option">
					 <label> Category </label>
					 <select name="category">
						<option> Select </option>
						<?php
                          $select_category = "SELECT* FROM category";
						  $select_query = $conn -> query($select_category);
						  while($category = mysqli_fetch_array($select_query)){
							echo "<option value='$category[id]'>$category[category]</option>";
						  }
						?>
					 </select>
					</div>
				   
				   <div class="form_item"> 
						<label> Product Details :  </label>
						<textarea  name="product_details"
						cols="50" rows="10"
						placeholder="porduct details"> </textarea>
				   </div>
				   <div>
						  <label for="produce_image">Product Image :</label>
						  <input type="file" name="produce_image" id="produce_image">
					</div>
					<div>
						<?php echo isset($_POST['upload_product']) ? "<p>". $message . "</p>" : "" ?>
					</div>
				   <input type="submit" name="upload_product" value="Add Product" class="product_add_btn">
				</form>
		</section>
	</body>
</html>