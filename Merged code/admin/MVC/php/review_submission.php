<?php
session_start();
include "../db/db.php";

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    header("Location: ../../../student/MVC/html/login.php");
    exit();
}

if (isset($_POST['submission_id']) && isset($_POST['action'])) {
    $submission_id = mysqli_real_escape_string($conn, $_POST['submission_id']);
    $action = mysqli_real_escape_string($conn, $_POST['action']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    
    // Validate action
    if ($action != 'approve' && $action != 'reject') {
        header("Location: ../html/review_submissions.php");
        exit();
    }
    
    // Set status based on action
    $status = ($action == 'approve') ? 'approved' : 'rejected';
    
    // Update submission
    $sql = "UPDATE student_submissions 
            SET status = '$status', 
                admin_comment = '$comment', 
                reviewed_at = NOW() 
            WHERE id = '$submission_id'";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: ../html/review_submissions.php?success=1");
    } else {
        header("Location: ../html/review_submissions.php?error=1");
    }
} else {
    header("Location: ../html/review_submissions.php");
}
exit();
?>