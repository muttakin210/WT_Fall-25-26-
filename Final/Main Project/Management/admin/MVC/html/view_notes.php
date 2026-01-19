<?php
session_start();
include "../db/db.php";

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    header("Location: ../../../student/MVC/html/login.php");
    exit();
}

$admin_id = $_SESSION['admin_id'];
$admin_name = $_SESSION['full_name'];

// Get search query if exists
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// Build query based on search
if ($search) {
    $sql = "SELECT * FROM materials WHERE admin_id = '$admin_id' AND (title LIKE '%$search%' OR description LIKE '%$search%') ORDER BY uploaded_at DESC";
} else {
    $sql = "SELECT * FROM materials WHERE admin_id = '$admin_id' ORDER BY uploaded_at DESC";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Uploaded Notes | Admin</title>
    <link rel="stylesheet" href="../css/view_notes.css">
</head>
<body>
    <div class="navbar">
        <h2>AIUB Notes – Admin</h2>
        <div class="nav-links">
            <a href="Dashboard.php">Dashboard</a>
            <a href="../php/logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <h1>My Uploaded Notes</h1>
        <p>Manage and view your uploaded course materials</p>

        <!-- Search Box -->
        <div class="search-box">
            <form method="GET" action="">
                <input type="text" name="search" placeholder="Search notes by title or description..." value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit">Search</button>
                <?php if ($search): ?>
                    <a href="view_notes.php" class="clear-search">Clear</a>
                <?php endif; ?>
            </form>
        </div>

        
</body>
</html>