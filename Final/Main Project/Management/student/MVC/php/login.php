<?php
session_start();
include "../db/db.php";

if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Check if email exists
    $sql = "SELECT * FROM students WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        
        if (password_verify($password, $user['password'])) {
    
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['full_name'] = $user['full_name'];

            header("Location: ../html/dashboard.php");
            exit();
        } else {
            $error = "Incorrect password!";
        }
    } else {
        $error = "Email not registered!";
    }
}
?>
