<?php
session_start();
include "../db/db.php";

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'student') {
    header("Location: ../html/login.php");
    exit();
}

if (isset($_POST['update'])) {
    $student_id = $_SESSION['user_id'];
    
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Fetch current student data
    $sql = "SELECT * FROM students WHERE id = '$student_id'";
    $result = mysqli_query($conn, $sql);
    $student = mysqli_fetch_assoc($result);
    
    if (!$student) {
        header("Location: ../html/update_profile.php?error=1");
        exit();
    }
    
    // Verify current password
    if (!password_verify($current_password, $student['password'])) {
        header("Location: ../html/update_profile.php?error=1");
        exit();
    }
    
    // Check if email is already taken by another student
    $email_check = "SELECT id FROM students WHERE email = '$email' AND id != '$student_id'";
    $email_result = mysqli_query($conn, $email_check);
    
    if (mysqli_num_rows($email_result) > 0) {
        header("Location: ../html/update_profile.php?error=1");
        exit();
    }
    
    // Prepare update query
    if (!empty($new_password)) {
        // Validate new password
        if ($new_password !== $confirm_password) {
            header("Location: ../html/update_profile.php?error=1");
            exit();
        }
        
        if (strlen($new_password) < 6) {
            header("Location: ../html/update_profile.php?error=1");
            exit();
        }
        
        // Update with new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_sql = "UPDATE students SET 
                       full_name = '$full_name',
                       email = '$email',
                       password = '$hashed_password'
                       WHERE id = '$student_id'";
    } else {
        // Update without changing password
        $update_sql = "UPDATE students SET 
                       full_name = '$full_name',
                       email = '$email'
                       WHERE id = '$student_id'";
    }
    
    if (mysqli_query($conn, $update_sql)) {
        // Update session data
        $_SESSION['full_name'] = $full_name;
        
        header("Location: ../html/update_profile.php?success=1");
        exit();
    } else {
        header("Location: ../html/update_profile.php?error=1");
        exit();
    }
} else {
    header("Location: ../html/update_profile.php");
    exit();
}
?>