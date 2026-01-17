<?php
include "../db/db.php";

if (isset($_POST['register'])) {

    $full_name   = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email       = mysqli_real_escape_string($conn, $_POST['email']);
    $password    = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit();
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    
    $sql = "INSERT INTO students (full_name, email, password)
            VALUES ('$full_name', '$email', '$hashed_password')";

    // Execute SQL
    if (mysqli_query($conn, $sql)) {
        
        header("Location: ../html/login.php?success=1");
        exit();
    } else {
        
        if (mysqli_errno($conn) == 1062) {
            header("Location: ../html/register.php?error=email");
            exit();
        } else {
            echo "Registration failed!";
        }
    }
}
?>
