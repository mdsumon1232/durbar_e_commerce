<?php
	require('../database_config/config.php');
  
	
	// ---------product update -------
   
	$product_id = $product_name = $product_band = $product_code = $product_price = $category_id  = $product_details = $product_img = "";

	if(isset($_GET['id'])){
		$id = $_GET['id'];

		$select_product = "SELECT * FROM product WHERE product_id = '$id'";
		$select_query = $conn -> query($select_product);
		$product_fetch = mysqli_fetch_array($select_query);

		$product_id = $product_fetch['product_id'];
		$product_name = $product_fetch['product_name'];
		$product_band = $product_fetch['product_band'];
		$product_code = $product_fetch['product_code'];
		$product_price = $product_fetch['product_price'];
		$product_details = $product_fetch['product_details'];
	}
    
    
    // product data update 

    $message = "";

	if(isset($_POST['upload_product'])){
		$product_id =  $_POST['product_id'];
 		$product_name = $_POST['product_name'];
		$product_code = $_POST['product_code'];
		$band = $_POST['band'];
		$price = $_POST['price'];
		$category =$_POST['category'];
		$product_details = $_POST['product_details'];

		if(empty($product_name) || empty($band) || empty($price) || empty($product_details)  || empty($product_code)){
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
                    $update_product = "UPDATE product SET product_name = '$product_name' , product_band = '$band' , product_code='$product_code' 
									,product_price = '$price' , product_details = '$product_details'  WHERE product_id = '$product_id' LIMIT 1";
					    
						$update_query = $conn -> query($update_product);
						if($update_query){
							header('location: product_list.php');
						}
						else{
							$message ="something wrong to update product data";
						}
					
				
				}
			}
		}
	}



?>

<!DOCTYPE HTML>
<html>
	<head>
		<title> product Update </title>
		<link rel="stylesheet" href="product_upload.css">
	</head>
	<body>
		<section class="product_add_container">
			
				<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" class="product_update_form">
				
				<h2> Add product </h2>
					<div class="form_item">
					<label> Product Name : </label>
					<input type="text" name="product_name" placeholder="product name" value="<?php echo $product_name?>">
					</div>
					
					<div class="form_item"> 
						<label> Product Code </label>
						<input type="text" name="product_code" placeholder="product code" value="<?php echo $product_code?>">
					</div>
					
					<div class="form_item">
						<label> Product Band </label>
						<input type="text" name="band" placeholder="band" value="<?php echo $product_band?>">
					</div>
					
					<div class="form_item">
						<label> Price </label>
						<input type="number" name="price" placeholder="product price" value="<?php echo $product_price?>">
					</div>
				
						<input type="text" name="product_id" value="<?php echo $product_id?>" hidden >
				
					<div class="form_option">
					 <label> Category </label>
					 <select name="category" value="<?php echo $category_id?>">
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
						placeholder="porduct details"> <?php echo $product_details?>  </textarea>
				   </div>
				   <div>
						  <label for="produce_image">Product Image :</label>
						  <input type="file" name="produce_image" id="produce_image" value="<?php echo $product_img?>">
					</div>
					<div>
						<?php echo isset($_POST['upload_product']) ? "<p>". $message . "</p>" : "" ?>
					</div>
				   <input type="submit" name="upload_product" value="Add Product" class="product_add_btn">
				</form>
		</section>
	</body>
</html>