<?php
session_start();
require('../database_config/config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="cart.css">
</head>
<body>
    <?php require('header.php') ?>
    <section class="cart_container">
        <div class="cart_items">
            <?php
            $user_id = $_SESSION['user']['user_id'];
            $select_product = "SELECT cart.*, product.* FROM product INNER JOIN cart ON cart.product_id = product.product_id WHERE user_id = '$user_id'";
            $product_query = $conn->query($select_product);
            echo "<div class='cart_product_container'>";
            $sub_total = 0;
            $product_id = [];
            while($fetch_product = mysqli_fetch_array($product_query)){
                echo '
                    <div class="product_details">
                        <div class="product_img">
                            <img src="'.$fetch_product['product_img'].'" >
                        </div>
                        <div class="quantity_box">
                            <p> '.$fetch_product['quantity'].' </p>
                        </div>
                        <h4 class="product_price">'. $fetch_product['product_price'] * $fetch_product['quantity'].' $</h4>
                        <a href="cart_product_delete.php?id='.$fetch_product['cart_id'] .'" class="delete_btn">d</a>
                    </div>
                ';
                $sub_total +=  $fetch_product['product_price'] * $fetch_product['quantity'];
                $product_id[] = $fetch_product['product_id'];
            }
            echo "</div>";

            $shipping = ($sub_total / 100) * 5;
            $total = $sub_total + $shipping;
            $product_id_string = implode(',', $product_id);
            ?>
            <div class="checkout_detail">
                <div class="cart">
                    <p>sub total: <?php echo round($sub_total, 2)?> </p>
                    <p>shipping: <?php echo round($shipping, 2) ?></p>
                    <hr class='line'>
                    <p class="total">total: <?php echo round($total, 2) ?></p>
                    <a href="./checkout.php?id=<?php echo $product_id_string ?>" class="checkout_btn">checkout</a>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
