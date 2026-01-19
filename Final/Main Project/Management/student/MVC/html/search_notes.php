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
$result = mysqli_query($conn, $sql);
if (!$result) {
    
    if ($search) {
        $sql = "SELECT m.*, t.full_name as admin_name FROM materials m 
                LEFT JOIN teachers t ON m.teacher_id = t.id 
                WHERE (m.title LIKE '%$search%' OR m.description LIKE '%$search%') 
                ORDER BY m.uploaded_at DESC";
    } else {
        $sql = "SELECT m.*, t.full_name as admin_name FROM materials m 
                LEFT JOIN teachers t ON m.teacher_id = t.id 
                ORDER BY m.uploaded_at DESC";
    }
    $result = mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Find Course Notes | Student</title>
    <link rel="stylesheet" href="../css/search_notes.css">
</head>
<body>
    <div class="navbar">
        <h2>AIUB Notes – Student</h2>
        <div class="nav-links">
            <a href="dashboard.php">Dashboard</a>
            <a href="../php/logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <h1>Find Your Course Notes</h1>
        <p>Search and download course materials uploaded by your instructors</p>

        <!-- Search Box -->
        <div class="search-box">
            <form method="GET" action="">
                <input type="text" name="search" placeholder="Search notes by title, description, or course..." value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit">Search</button>
                <?php if ($search): ?>
                    <a href="search_notes.php" class="clear-search">Clear</a>
                <?php endif; ?>
            </form>
        </div>

        
</body>
</html>