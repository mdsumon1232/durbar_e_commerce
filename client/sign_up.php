<?php
    require('../database_config/config.php');
  
    $message = "";
     $full_name = $email = $password = $confirm_password ="";
    if(isset($_POST['sign_up'])){
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $encrypt_password = password_hash($password , PASSWORD_DEFAULT);
        $confirm_password = $_POST['confirm_password'];
        echo $full_name . $email . $password .$confirm_password;
        if(strlen($password) <6){
            $message = "password minimum 6 character";
        }
        else{
            if($password !== $confirm_password){
                $message ="password does not match";
            }
            else{
                $already_exit_email = "SELECT * FROM user WHERE email = '$email'";
                $query = $conn -> query($already_exit_email);
                if($query -> num_rows > 0){
                    $message ="email already used";
                }
                else{
                    $insert_user_data = "INSERT INTO user (full_name , email  , password)
                                          VALUES ('$full_name' , '$email' , '$encrypt_password')";
                    $user_data_query = $conn ->query($insert_user_data);
                    if($user_data_query){
                        header('location: login.php');
                    }
                    else{
                        $message = "something wrong! try again";
                    }
                }
            }
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
        
            <form action="sign_up.php" method="POST" class="form">
                <h2>User Sign Up</h2>
               <div class="form_item">
                    <label for="">Full Name</label>
                    <input type="text" name="full_name" placeholder="Enter Your Full Name" value = "<?php echo $full_name ?>" require>
                </div>
                <div class="form_item">
                    <label for="">Email</label>
                    <input type="email" name="email" placeholder="Enter Your Email" require value="<?php echo $email ?>">
                </div>
                <div class="form_item">
                    <label for="">Password</label>
                    <input type="password" name="password" placeholder="Enter Your Password" require value="<?php echo $password ?>">
                </div>
                <div class="form_item">
                    <label for="">Confirm Password</label>
                    <input type="password" name="confirm_password" placeholder="Enter Your confirm Password" require value="<?php echo $confirm_password ?>">
                </div>
                <div>
                    <?php echo isset($_POST['sign_up']) ? "<p>" . $message ."</p>" : "" ?>
                </div>
                <input type="submit" value="Sign Up" name="sign_up" class="login_btn">
                <p class='account_status'>Have an account ? <a href="login.php">Sign up</a></p>
            </form>
        
    </section>
</body>
</html>