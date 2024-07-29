<?php
    session_start();
    require('../database_config/config.php');
  
    $full_name = $user_id = "";
  
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        
        $select_user_from_db = "SELECT * FROM user WHERE user_id = '$id'";
        $query = $conn -> query($select_user_from_db);
        $fetch_user_data = mysqli_fetch_array($query);
        $full_name = $fetch_user_data['full_name'];
        $user_id = $fetch_user_data['user_id'];
    }
//   update user data

$message = "";

if(isset($_POST['update_profile'])){
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $number = $_POST['phone'];
    $gender = $_POST['gender'];
    $birth = $_POST['birth'];
    $profile_name = $_FILES['profile']['name'];
    $profile_tmp_name = $_FILES['profile']['tmp_name'];

    if(!empty($full_name) && !empty($number) && !empty($gender) && !empty($birth) && !empty($profile_name)){
      $image_folder = '../images/'.$profile_name;
      move_uploaded_file($image_folder , $profile_tmp_name);
      $user_update = "UPDATE user SET full_name = '$full_name' , gender = '$gender' , phone ='$number' , birth = '$birth',
                      user_img = '$image_folder' WHERE user_id = '$id'  LIMIT 1";
      $update_query = $conn ->query($user_update);
      if($update_query){
         $select_updated_user_data = "SELECT * FROM user WHERE user_id = '$id'";
         $updated_data_fetch = mysqli_fetch_array($conn -> query($select_updated_user_data));
        $_SESSION['user'] = $updated_data_fetch;
        header('location: user_profile.php');
      }
      else{
        $message = "Something wrong! try again";
      }
    }
    else{
        $message = "All flied are required";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user update</title>
    <link rel="stylesheet" href="user_update.css">
</head>
<body>
    <section class="user_update_container">
        <form action="user_update.php" method="POST" enctype='multipart/form-data' class="form">
            <h2>User Profile Update</h2>
            <div class="form_item">
                <label for="">Full Name</label>
                <input type="text" name="full_name" value="<?php echo $full_name ?>">
            </div>
            <input type="text" name="id" value="<?php echo $user_id ?>" hidden>
            <div class="form_item">
                <label for="">Number</label>
                <input type="number" name="phone">
            </div>
            <div class="gender_box">
                <label for="">Gender</label>
                <select name="gender" id="">
                    <option value="">select</option>
                    <option value="Female">Female</option>
                    <option value="Male">Male</option>
                </select>
            </div>
            <div class="form_item">
                <label for="">Date Of Birth</label>
                <input type="date" name="birth">
            </div>
            
            <div class="form_item">
                <label for="profile">Profile</label>
                <input type="file" name='profile' id='profile'>
            </div>
            <div>
            <?php  echo isset($_POST['update_profile']) ? "<p>" . $message ."</p>" : "" ?> 
           </div>
            <input type="submit" value="update profile" name='update_profile' class="update_btn">
        </form>
    </section>
</body>
</html>