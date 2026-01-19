<?php
session_start();
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'teacher') {
    header("Location: ../../../Teacher/MVC/html/teacher_login.php");
    exit();
}

$teacher_id = $_SESSION['teacher_id']; 
$teacher_name = $_SESSION['full_name'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teacher Dashboard | AIUB Notes</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <div class="navbar">
        <h2>AIUB Notes – Teacher</h2>
        <a href="../php/logout.php">Logout</a>
    </div>

    <div class="container">
        <h1>Welcome, MR. <?php echo htmlspecialchars($teacher_name); ?></h1>
        <p>Manage your courses and materials</p>

        <div class="cards">
            
    </div>
</body>
</html>
