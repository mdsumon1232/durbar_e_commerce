<?php
require('../database_config/config.php');

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        
        $delete_data = "DELETE FROM category WHERE id = '$id' LIMIT 1";
       $delete_query = $conn -> query($delete_data);
       if($delete_data){
        header('location: category_update.php?delete=delete_successful');
       }
    }
  
?>