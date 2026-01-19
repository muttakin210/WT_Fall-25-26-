<?php
session_start();
include "../db/db.php";

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM materials WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $row['file_name'] . '"');
        echo $row['file_data'];
    }
}
?>