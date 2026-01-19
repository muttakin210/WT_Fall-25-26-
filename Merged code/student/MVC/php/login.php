<?php
session_start();
include "../db/db.php";

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Simplified: No hashing, checks students table only
    $sql = "SELECT * FROM students WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_type'] = 'student';
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['full_name'] = $user['full_name'];

        header("Location: ../html/dashboard.php");
        exit();
    } else {
        header("Location: ../html/login.php?error=1");
        exit();
    }
}
?>