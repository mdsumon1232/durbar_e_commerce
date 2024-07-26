<?php
    require('../database_config/config.php');

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $delete_product = "DELETE FROM product WHERE product_id = '$id' LIMIT 1";
        $delete_query = $conn -> query($delete_product);
        if($delete_query){
            header('location:product_list.php');
        }
        else{
            echo "something wrong to delete product";
        }
    }

?>