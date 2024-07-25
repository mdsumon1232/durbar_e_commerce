<?php
    require('../database_config/config.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>product list</title>
    <link rel="stylesheet" href="product_list.css">
</head>
<body>
    <section class="productListContainer">
     <div class="productList">
        <table>
            <caption><h2>Product List</h2></caption>
            <thead>
                <tr>
                    <th>Id No.</th>
                    <th>Name</th>
                    <th>Product Code</th>
                    <th>Band</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Details</th>
                    <th>Image</th>
                    <th colspan='2'>Action</th>
                </tr>
            </thead>
            <tbody>

              <?php

                  $select_product = "SELECT product.* , category.category FROM category INNER JOIN  product ON product.category_id = category.id";

                  $product_query = $conn -> query($select_product);
                  if($product_query -> num_rows>0){
                    while($product = mysqli_fetch_array($product_query)){

                        echo "
                             <tr>
                    <td>$product[product_id]</td>
                    <td>$product[product_name]</td>
                    <td>$product[product_code]/td>
                    <td>$product[product_band]</td>
                    <td>$product[product_price]</td>
                    <td>$product[category]</td>
                    <td>$product[product_details]</td>
                    <td><img src='$product[product_img]'></td>
                    <td><a href='product_upload.php?edit=$product[product_id]'>Edit</a></td>
                    <td><a href=''>Delete</a></td>
                </tr>
                        ";
                    
                    }
                  }
                  else{
                    echo "<p> Empty </p>";
                  }

              ?>
            </tbody>
        </table>
     </div>
    </section>
</body>
</html>