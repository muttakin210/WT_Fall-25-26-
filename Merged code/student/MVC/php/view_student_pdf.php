<?php
session_start();
include "../db/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../html/login.php");
    exit();
}

if (isset($_GET['id'])) {
    $note_id = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "SELECT * FROM materials WHERE id = '$note_id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
    
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . $row['file_name'] . '"');
        
        echo $row['file_data'];
    } else {
        echo "File not found.";
    }
} else {
    header("Location: ../html/search_notes.php");
}
?>