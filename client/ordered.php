<?php
        session_start();
        require('../database_config/config.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordered</title>
    <link rel="stylesheet" href="ordered.css">
</head>
<body>
    <?php require('header.php') ?>
    <section class="ordered_container">
        <h2 > Ordered Product   </h2>
            <div class="container">
                <?php
                 $user_id = $_SESSION['user']['user_id'];
                 $order_data = "SELECT product_orderd. * , product.product_name , product.product_price , product.product_img FROM product INNER JOIN product_orderd ON 
                               product_orderd.product_id = product.product_id WHERE user_id = '$user_id' ";
                 $order_query = $conn -> query($order_data);

                 if($order_query -> num_rows >0){
                    while($order_data = mysqli_fetch_array($order_query)){
                      
                        echo '
                             <div class="order_item">
                    <img src="'.$order_data['product_img'].'" alt="">
                    <div class="name_quantity">
                        <p>'.$order_data['product_name'].'</p>
                        <p>quantity</p>
                    </div>
                    <p>'.$order_data['product_price'].'</p>
                    <p>Ordered date: '.$order_data['order_at'].'</p>
                </div>
                        ';

                    }
                 }
                 else{
                    echo "<p> No ordered product . To order <a href='index.php'> click here </a> </p>";
                 }
                
                ?>
            </div>
        
    </section>
</body>
</html>