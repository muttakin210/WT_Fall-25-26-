<?php
session_start();
session_unset();
session_destroy();

// Clear remember me cookies
setcookie('remember_email', '', time() - 3600, '/');
setcookie('remember_password', '', time() - 3600, '/');
setcookie('user_type', '', time() - 3600, '/');

header("Location: ../../../student/MVC/html/login.php");
exit();
?>
