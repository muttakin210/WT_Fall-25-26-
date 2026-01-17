<?php
session_start();
include "../db/db.php"; // student login PHP is here

if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // 1️⃣ Check students table first
    $sql_student = "SELECT * FROM students WHERE email='$email'";
    $result_student = mysqli_query($conn, $sql_student);

    if (mysqli_num_rows($result_student) == 1) {
        $user = mysqli_fetch_assoc($result_student);
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_type'] = 'student';
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['full_name'] = $user['full_name'];

            // Correct student dashboard path
            header("Location: ../html/dashboard.php");
            exit();
        }
    }

    // 2️⃣ Check teachers table
    $sql_teacher = "SELECT * FROM teachers WHERE email='$email' AND password='$password'";
    $result_teacher = mysqli_query($conn, $sql_teacher);

    if (mysqli_num_rows($result_teacher) == 1) {
        $teacher = mysqli_fetch_assoc($result_teacher);
        $_SESSION['user_type'] = 'teacher';
        $_SESSION['user_id'] = $teacher['id'];
        $_SESSION['full_name'] = $teacher['full_name'];

        // Correct teacher dashboard path from student/MVC/php/
        header("Location: ../../../Teacher/MVC/html/dashboard.php");
        exit();
    }

    // 3️⃣ Login failed
    header("Location: ../html/login.php?error=1");
    exit();
}
?>
