<!DOCTYPE html>
<html>
<head>
    <title>Login | AIUB Notes</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="login-box">
        <h2>Login</h2>
        <form method="POST" action="../php/login.php">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
        <p>No account? <a href="register.php">Register</a></p>
    </div>
</body>
</html>