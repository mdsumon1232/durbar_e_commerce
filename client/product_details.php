<?php 
  session_start();
 
?>


<?php  require('../database_config/config.php')  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>product details</title>
    <link rel="stylesheet" href="product_details.css">
</head>
<body>
    <?php  require('./header.php') ?>
    <div class="main_section">
        <div class="product_detail_container">
            <?php

                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    echo $id;
                    $select_product = "SELECT * FROM product WHERE product_id = '$id'";
                    $product_query = $conn -> query($select_product);
                    if($product_query -> num_rows > 0){
                       
                        $data = mysqli_fetch_array($product_query);
                            echo "
                                     <div class='details_img'>
                                        <img src='$data[product_img]'>
                                    </div>
                                    <div class='product_details'>
                                        <H2>product Name : $data[product_name]</H2>
                                            <p>$data[product_details]</p>
                                                <p>Product Category Electronics:</p>
               
                                                     <div class='product_bp'>
                                                       <p>price : $data[product_price]$</p>
                                                        <p>Band: $data[product_code]</p>
                                                    </div>
                                                    <p>Product Code : $data[product_code] </p>
                                                <p>Stock : 100</p>

                                            <a href='add_to_cart.php?id=$data[product_id]'> <button class='product_details_btn'>Add cart</button> </a>
                                    </div>    
                                ";
                        

                    }
                    else{
                        echo "<p> Product Not Found </p>";
                    }
                }

            ?>

        </div>
    </div>
</body>
</html>