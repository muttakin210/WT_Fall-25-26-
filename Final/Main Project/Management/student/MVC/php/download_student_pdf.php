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

?>