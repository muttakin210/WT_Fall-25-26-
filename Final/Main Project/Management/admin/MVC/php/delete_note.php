<?php
session_start();
include "../db/db.php";

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    header("Location: ../../../student/MVC/html/login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: ../html/view_notes.php");
    exit();
}

$note_id = mysqli_real_escape_string($conn, $_GET['id']);
$admin_id = $_SESSION['admin_id'];

// Check if admin_id or teacher_id column exists and delete accordingly
$check_admin_column = "SHOW COLUMNS FROM materials LIKE 'admin_id'";
$admin_result = mysqli_query($conn, $check_admin_column);

if (mysqli_num_rows($admin_result) > 0) {
    $sql = "DELETE FROM materials WHERE id = '$note_id' AND admin_id = '$admin_id'";
} else {
    $sql = "DELETE FROM materials WHERE id = '$note_id' AND teacher_id = '$admin_id'";
}

if (mysqli_query($conn, $sql)) {
    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>alert('Note deleted successfully!');</script>";
    } else {
        echo "<script>alert('Note not found or access denied!');</script>";
    }
} else {
    echo "<script>alert('Error deleting note!');</script>";
}


?>