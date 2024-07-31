<?php
    session_start();

    require('../database_config/config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user profile</title>
    <link rel="stylesheet" href="user_profile.css">
</head>
<?php  require('header.php') ?>
<body>
    <section class="profile_container">
        <div class="profile-details">

          <?php
           
           if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
              $user = $_SESSION['user'];
              echo '
                    <img src="' . (isset($user['user_img']) ? $user['user_img'] : '../images/user.png') . '" class="profile_image">
                    <div class="user_information">
                        <p>Name : ' . (isset($user['full_name']) ? $user['full_name'] : '-----------') . '</p>
                        <p>Phone : ' . (isset($user['phone']) ? $user['phone'] : '-----------') . '</p>
                        <p>Email : ' . (isset($user['email']) ? $user['email'] : '-----------') . '</p>
                        <p>Gender : ' . (isset($user['gender']) ? $user['gender'] : '-----------') . '</p>
                        <p>Date of Birth : ' . (isset($user['birth']) ? $user['birth'] : '-----------') . '</p>
                    </div>
                    <p>Join durbar e-commerce at : ' . $user['create_at'] . '</p>
                   <a href="user_update.php?id=' . $user['user_id'] . '" class="edit_btn">Edit profile</a>

                    ';
           }
         

          ?>
             
        </div>
    </section>
</body>
</html>