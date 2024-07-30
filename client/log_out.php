<?php
session_start();
session_unset();
session_destroy();

// Delete the remember me cookie
setcookie("remember", "", time() - 3600);

header('location: login.php');
?>
