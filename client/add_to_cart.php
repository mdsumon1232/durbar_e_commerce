<?php

session_start();
require('../database_config/config.php');

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $user_id = $_SESSION['user']['user_id'];
    $product_quantity = 1;

    // Check if product already exists
    $cart_product = "SELECT * FROM cart WHERE product_id = '$product_id' AND user_id = '$user_id'";
    $cart_query = $conn->query($cart_product);

    if ($cart_query->num_rows > 0) {
        // Product already exists, increment quantity
        $fetch_cart = mysqli_fetch_array($cart_query);
        $product_quantity = $fetch_cart['quantity'] + 1;
        $increase = "UPDATE cart SET quantity = $product_quantity WHERE product_id = '$product_id' AND user_id = '$user_id'";
      $increase_to_cart = $conn->query($increase);
      if($increase_to_cart){
        header('location:cart.php');
      }
    } else {
        // Product doesn't exist, insert it with quantity 1
        $insert_to_cart = "INSERT INTO cart (product_id, quantity, user_id) VALUES ('$product_id', '$product_quantity', '$user_id')";
       $add_to_cart = $conn->query($insert_to_cart);
       if($add_to_cart){
        header('location: cart.php');
       }
    }
}

?>
