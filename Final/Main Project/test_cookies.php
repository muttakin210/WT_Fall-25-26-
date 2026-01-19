<!DOCTYPE html>
<html>
<head>
    <title>Cookie Test</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .cookie-info { background: #f0f0f0; padding: 15px; margin: 10px 0; border-radius: 5px; }
        .clear-btn { background: #dc3545; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Cookie Information</h1>
    
    <div class="cookie-info">
        <h3>Current Cookies:</h3>
        <?php
        if (empty($_COOKIE)) {
            echo "<p>No cookies found.</p>";
        } else {
            foreach ($_COOKIE as $name => $value) {
                echo "<p><strong>$name:</strong> " . htmlspecialchars($value) . "</p>";
            }
        }
        ?>
    </div>
    
    <div class="cookie-info">
        <h3>Remember Me Cookies:</h3>
        <p><strong>Email:</strong> <?php echo isset($_COOKIE['remember_email']) ? htmlspecialchars($_COOKIE['remember_email']) : 'Not set'; ?></p>
        <p><strong>Password:</strong> <?php echo isset($_COOKIE['remember_password']) ? '***hidden***' : 'Not set'; ?></p>
        <p><strong>User Type:</strong> <?php echo isset($_COOKIE['user_type']) ? htmlspecialchars($_COOKIE['user_type']) : 'Not set'; ?></p>
    </div>
    
    <form method="POST">
        <button type="submit" name="clear_cookies" class="clear-btn">Clear All Cookies</button>
    </form>
    
    <?php
    if (isset($_POST['clear_cookies'])) {
        // Clear all cookies
        foreach ($_COOKIE as $name => $value) {
            setcookie($name, '', time() - 3600, '/');
        }
        echo "<p style='color: green;'>All cookies cleared! Refresh the page to see changes.</p>";
    }
    ?>
    
    <p><a href="Management/student/MVC/html/login.php">Go to Login Page</a></p>
</body>
</html>