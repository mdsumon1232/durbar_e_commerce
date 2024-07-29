<?php
     session_start();
     require('../database_config/config.php');
     $message = "";

     if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $check_email = "SELECT * FROM user WHERE email = '$email'";
        $query = $conn -> query($check_email);
        if($query -> num_rows > 0){
          $user_data = mysqli_fetch_array($query);
          $check_email = password_verify($password , $user_data['password']);
          if($check_email){
            header('location: index.php');
            $_SESSION['user'] = $user_data;
          }
          else{
            $message ="wrong password";
          }
        }
        else{
            $message = "invalid email";
        }

     }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user login</title>
     <link rel="stylesheet" href="login.css">
</head>
<body>
    <section class="login_section">
        
            <form action="login.php" method="POST" class="form">
                <h2>User Login</h2>
                <div class="form_item">
                    <label for="">Email</label>
                    <input type="email" name="email" placeholder="Enter Your Email" require>
                </div>
                <div class="form_item">
                    <label for="">Password</label>
                    <input type="password" name="password" placeholder="Enter Your Password" require>
                </div>
                <div>
                    <?php echo isset($_POST['login']) ? "<p>" . $message . "</p>" : ""  ?>
                </div>
                <input type="submit" value="login" name="login" class="login_btn">
                <p class='account_status'>No account ? <a href="sign_up.php">Sign up</a></p>
            </form>
        
    </section>
</body>
</html>