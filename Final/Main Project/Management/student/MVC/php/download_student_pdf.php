<?php
session_start();
include "../db/db.php";

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'student') {
    header("Location: ../html/login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: ../html/search_notes.php");
    exit();
}

$note_id = mysqli_real_escape_string($conn, $_GET['id']);

// Students can download any note - no restriction by admin_id
$sql = "SELECT * FROM materials WHERE id = '$note_id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . $row['file_name'] . '"');
    header('Content-Length: ' . strlen($row['file_data']));
    
    
} else {
    echo "<script>alert('File not found');</script>";
    echo "<script>window.location.href='../html/search_notes.php';</script>";
}
?>