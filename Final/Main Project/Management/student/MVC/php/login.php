<?php
session_start();
include "../db/db.php";

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    // 1️⃣ Check students table first
    $sql_student = "SELECT * FROM students WHERE email='$email'";
    $result_student = mysqli_query($conn, $sql_student);

    if (mysqli_num_rows($result_student) == 1) {
        $user = mysqli_fetch_assoc($result_student);
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_type'] = 'student';
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['full_name'] = $user['full_name'];

            // Handle remember me for students
            if ($remember) {
                setcookie('remember_email', $email, time() + (30 * 24 * 60 * 60), '/'); // 30 days
                setcookie('remember_password', $password, time() + (30 * 24 * 60 * 60), '/'); // 30 days
                setcookie('user_type', 'student', time() + (30 * 24 * 60 * 60), '/');
            } else {
                // Clear cookies if not remembering
                setcookie('remember_email', '', time() - 3600, '/');
                setcookie('remember_password', '', time() - 3600, '/');
                setcookie('user_type', '', time() - 3600, '/');
            }

            header("Location: ../html/dashboard.php");
            exit();
        }
    }

    // 2️⃣ Check admins table
    $sql_admin = "SELECT * FROM admins WHERE email='$email'";
    $result_admin = mysqli_query($conn, $sql_admin);

    if (mysqli_num_rows($result_admin) == 1) {
        $admin = mysqli_fetch_assoc($result_admin);
        
        // Check both hashed and plain text passwords for compatibility
        if (password_verify($password, $admin['password']) || $password === $admin['password']) {
            $_SESSION['user_type'] = 'admin';
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['full_name'] = $admin['full_name'];

            // Handle remember me for admins
            if ($remember) {
                setcookie('remember_email', $email, time() + (30 * 24 * 60 * 60), '/'); // 30 days
                setcookie('remember_password', $password, time() + (30 * 24 * 60 * 60), '/'); // 30 days
                setcookie('user_type', 'admin', time() + (30 * 24 * 60 * 60), '/');
            } else {
                // Clear cookies if not remembering
                setcookie('remember_email', '', time() - 3600, '/');
                setcookie('remember_password', '', time() - 3600, '/');
                setcookie('user_type', '', time() - 3600, '/');
            }

            header("Location: ../../../admin/MVC/html/Dashboard.php");
            exit();
        }
    }

    // 3️⃣ Login failed
    header("Location: ../html/login.php?error=1");
    exit();
}
?>
