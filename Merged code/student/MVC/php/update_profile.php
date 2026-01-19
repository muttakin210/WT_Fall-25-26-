<?php
session_start();
include "../db/db.php";

if (isset($_POST['update'])) {
    $id = $_SESSION['user_id'];
    $name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $curr_pass = $_POST['current_password'];
    $new_pass = $_POST['new_password'];

    $sql = "SELECT * FROM students WHERE id = '$id'";
    $res = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($res);

    if ($curr_pass !== $user['password']) {
        header("Location: ../html/update_profile.php?error=1");
        exit();
    }

    $update_pass = !empty($new_pass) ? $new_pass : $curr_pass;
    $update_sql = "UPDATE students SET full_name='$name', email='$email', password='$update_pass' WHERE id='$id'";

    if (mysqli_query($conn, $update_sql)) {
        $_SESSION['full_name'] = $name;
        header("Location: ../html/update_profile.php?success=1");
    }
    exit();
}
?>