<?php
include "../db/db.php"
$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Database connection failed");
}

if (isset($_POST['register'])) {

    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit();
    }
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $check = "SELECT * FROM students WHERE email='$email' OR student_id='$student_id'";
    $result = mysqli_query($conn, $check);

    if (mysqli_num_rows($result) > 0) {
        echo "Email or Student ID already registered!";
        exit();
    }
    $sql = "INSERT INTO students (full_name, student_id, email, password)
            VALUES ('$full_name', '$student_id', '$email', '$hashed_password')";

    if (mysqli_query($conn, $sql)) {
        echo "Registration successful! <a href='login.php'>Login Now</a>";
    } else {
        echo "Error: Registration failed!";
    }
}
?>