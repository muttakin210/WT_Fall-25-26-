<?php
session_start();
include "../db/db.php";

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    header("Location: ../../../student/MVC/html/login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: ../html/review_submissions.php");
    exit();
}

$submission_id = mysqli_real_escape_string($conn, $_GET['id']);

$sql = "SELECT * FROM student_submissions WHERE id = '$submission_id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . $row['file_name'] . '"');
    header('Content-Length: ' . strlen($row['file_data']));
    
    echo $row['file_data'];
} else {
    echo "<script>alert('Submission not found');</script>";
    echo "<script>window.location.href='../html/review_submissions.php';</script>";
}
?>