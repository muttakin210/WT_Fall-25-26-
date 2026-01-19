<?php
include "../db/db.php";

if (isset($_POST['register'])) {
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        die("Passwords do not match!");
    }

    // Simplified: Saves password as plain text
    $sql = "INSERT INTO students (full_name, email, password) VALUES ('$full_name', '$email', '$password')";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../html/login.php?success=1");
    } else {
        header("Location: ../html/register.php?error=email");
    }
    exit();
}
?>