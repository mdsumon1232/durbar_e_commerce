<?php
  require('../database_config/config.php');
   if(isset($_GET['id'])){
    $id=$_GET['id'];
    $delete_cart = "DELETE FROM cart WHERE cart_id = '$id' ";
    $delete_query = $conn->query($delete_cart);
    if($delete_query){
        header('location:cart.php');
    }
   }


?>