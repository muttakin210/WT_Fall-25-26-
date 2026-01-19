<?php
session_start();
include "../db/db.php"; // student login PHP is here

if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    
    $sql_student = "SELECT * FROM students WHERE email='$email'";
    $result_student = mysqli_query($conn, $sql_student);

    if (mysqli_num_rows($result_student) == 1) {
        $user = mysqli_fetch_assoc($result_student);
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_type'] = 'student';
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['full_name'] = $user['full_name'];

            
            header("Location: ../html/dashboard.php");
            exit();
        }
    }

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $password = $_POST['password'];

    // ADMIN LOGIN
    $sql_admin = "SELECT * FROM admins WHERE email='$email'";
    $result_admin = mysqli_query($conn, $sql_admin);

    if (mysqli_num_rows($result_admin) === 1) {
        $admin = mysqli_fetch_assoc($result_admin);

        // NORMAL PASSWORD CHECK
        if ($password === $admin['password']) {
            $_SESSION['user_type'] = 'admin';
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['full_name'] = $admin['full_name'];

            header("Location: ../../../admin/MVC/html/dashboard.php");
            exit();
        }
    }

    header("Location: ../html/login.php?error=1");
    exit();
}

    
    

    header("Location: ../html/login.php?error=1");
    exit();
}
?>
