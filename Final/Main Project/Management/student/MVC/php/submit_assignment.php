<?php
session_start();
include "../db/db.php";

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'student') {
    header("Location: ../html/login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $student_id = $_SESSION['user_id'];
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $fileName = $_FILES['file']['name'];
    $fileType = $_FILES['file']['type'];
    $fileTmp = $_FILES['file']['tmp_name'];

    // Allow only PDF
    if ($fileType != "application/pdf") {
        header("Location: ../html/submit_assignment.php?error=1");
        exit();
    }

    // Read file data
    $fileData = addslashes(file_get_contents($fileTmp));

    // Insert submission
    $sql = "INSERT INTO student_submissions 
            (student_id, title, description, file_name, file_type, file_data, status)
            VALUES 
            ('$student_id', '$title', '$description', '$fileName', '$fileType', '$fileData', 'pending')";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../html/submit_assignment.php?success=1");
    } else {
        header("Location: ../html/submit_assignment.php?error=1");
    }
} else {
    header("Location: ../html/submit_assignment.php");
}
exit();
?>