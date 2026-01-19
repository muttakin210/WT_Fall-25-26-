<?php
session_start();
include "../db/db.php";

/* Security check */
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'teacher') {
    header("Location: ../../../Teacher/MVC/html/teacher_login.php");
    exit();
}

if (isset($_POST['update'])) {

    $teacher_id = $_SESSION['teacher_id'];

    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email     = mysqli_real_escape_string($conn, $_POST['email']);
    $password  = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "UPDATE teacher 
            SET full_name='$full_name',
                email='$email',
                password='$password'
            WHERE id='$teacher_id'";

    if (mysqli_query($conn, $sql)) {

        /* Update session name for dashboard */
        $_SESSION['full_name'] = $full_name;

        echo "<script>alert('Profile updated successfully');</script>";
        echo "<script>window.location.href='dashboard.php';</script>";

    } else {
        echo "Profile update failed!";
    }
}
?>
