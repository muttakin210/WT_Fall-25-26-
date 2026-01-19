<?php
session_start();
include "../db/db.php";

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'student') {
    header("Location: login.php");
    exit();
}

$student_name = $_SESSION['full_name'];

// Get search query if exists
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';


if ($search) {
    $sql = "SELECT m.*, a.full_name as admin_name FROM materials m 
            LEFT JOIN admins a ON m.admin_id = a.id 
            WHERE (m.title LIKE '%$search%' OR m.description LIKE '%$search%') 
            ORDER BY m.uploaded_at DESC";
} else {
    $sql = "SELECT m.*, a.full_name as admin_name FROM materials m 
            LEFT JOIN admins a ON m.admin_id = a.id 
            ORDER BY m.uploaded_at DESC";
}

// Fallback for old database structure

</body>
</html>