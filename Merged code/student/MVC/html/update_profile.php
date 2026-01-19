<!DOCTYPE html>
<html>
<head>
    <title>Update Profile</title>
    <link rel="stylesheet" href="../css/update_profile.css">
</head>
<body>
    <form method="POST" action="../php/update_profile.php">
        <input type="text" name="full_name" placeholder="New Name">
        <input type="email" name="email" placeholder="New Email">
        <input type="password" name="current_password" placeholder="Current Password" required>
        <input type="password" name="new_password" placeholder="New Password">
        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>