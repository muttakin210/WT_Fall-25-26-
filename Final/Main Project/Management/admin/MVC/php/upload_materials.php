<?php
session_start();
include "../db/db.php";

/* Check teacher login */
if (!isset($_SESSION['teacher_id'])) {
    header("Location: ../login.php");
    exit();
}

if (isset($_POST['upload'])) {

    $teacher_id = $_SESSION['teacher_id'];
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $fileName = $_FILES['file']['name'];
    $fileType = $_FILES['file']['type'];
    $fileTmp  = $_FILES['file']['tmp_name'];

    
}
?>
