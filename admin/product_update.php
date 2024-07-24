<!DOCTYPE HTML>
<html>
	<head>
		<title> admin/product update </title>
		<link rel="stylesheet" href="product_update.css">
	</head>
	<body>
		<section class="product_add_container">
			
				<form action="" name="product_update" class="product_update_form">
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
					 <select>
						<option> Stationary </option>
						<option> Electronics </option>
					 </select>
					</div>
				   
				   <div class="form_item"> 
						<label> Product Details :  </label>
						<textarea  name="product_details"
						cols="50" rows="10"
						placeholder="porduct details"> </textarea>
				   </div>
				   <input type="submit" name="add_product" value="Add Product" class="product_add_btn">
				</form>
		</section>
	</body>
</html>