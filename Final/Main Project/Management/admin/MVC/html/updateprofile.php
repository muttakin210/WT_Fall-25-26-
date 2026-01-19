<?php
session_start();
include "../db/db.php";

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'teacher') {
    header("Location: ../../../Teacher/MVC/html/teacher_login.php");
    exit();
}

if (!isset($_SESSION['teacher_id'])) {
    header("Location: ../../../Teacher/MVC/html/teacher_login.php");
    exit();
}

$teacher_id = $_SESSION['teacher_id'];

/* Fetch teacher info safely */
$stmt = $conn->prepare("SELECT * FROM teachers WHERE id = ?");
$stmt->bind_param("i", $teacher_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Profile | Teacher</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
<div class="navbar">
    <h2>AIUB Notes – Teacher</h2>
    <a href="../php/logout.php">Logout</a>
</div>

<div class="container">
    <h1>Update Profile</h1>

    <form action="updateprofile_action.php" method="POST">
        <label>Full Name</label>
        <input type="text" name="full_name" value="<?php echo htmlspecialchars($row['full_name']); ?>" required>

        <label>Email</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>

        <label>Password</label>
        <input type="text" name="password" value="<?php echo htmlspecialchars($row['password']); ?>" required>

        <button type="submit" name="update">Update Profile</button>
    </form>
</div>
</body>
</html>
