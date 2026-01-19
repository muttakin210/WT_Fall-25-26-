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

// Check if admin_id or teacher_id column exists and fetch accordingly
$check_admin_column = "SHOW COLUMNS FROM materials LIKE 'admin_id'";
$admin_result = mysqli_query($conn, $check_admin_column);

?>