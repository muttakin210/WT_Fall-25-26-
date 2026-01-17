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

    /* Allow only PDF */
    if ($fileType != "application/pdf") {
        echo "<script>alert('Only PDF files are allowed');</script>";
        exit();
    }

    /* Read file data */
    $fileData = addslashes(file_get_contents($fileTmp));

    $sql = "INSERT INTO materials 
            (teacher_id, title, description, file_name, file_type, file_data)
            VALUES 
            ('$teacher_id', '$title', '$description', '$fileName', '$fileType', '$fileData')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('PDF uploaded successfully!');</script>";
        echo "<script>window.location.href='../teacher/upload_materials.php';</script>";
    } else {
        echo "Upload failed!";
    }
}
?>
