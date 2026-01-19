<!DOCTYPE html>
<html>
<head>
    <title>Login | AIUB Notes</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>

    <div class="login-box">
        <h2>Login</h2>
        <p>AIUB Student Notes & Slides</p>

        <!-- show messages -->
        <?php
        if (isset($_GET['error'])) {
            echo "<p style='color:red; text-align:center;'>Invalid email or password</p>";
        }
        if (isset($_GET['success'])) {
            echo "<p style='color:green; text-align:center;'>Registration successful! Please login.</p>";
        }
        ?>

        <form method="POST" action="../php/login.php">
            <input type="email" name="email" placeholder="Email Address" value="<?php echo isset($_COOKIE['remember_email']) ? htmlspecialchars($_COOKIE['remember_email']) : ''; ?>" required>
            <input type="password" name="password" placeholder="Password" value="<?php echo isset($_COOKIE['remember_password']) ? htmlspecialchars($_COOKIE['remember_password']) : ''; ?>" required>

            <div class="remember-me">
                <input type="checkbox" id="remember" name="remember" <?php echo isset($_COOKIE['remember_email']) ? 'checked' : ''; ?>>
                <label for="remember">Remember Me</label>
            </div>

            <button type="submit" name="login">Login</button>
        </form>

        <p class="link">
            Don’t have an account?
            <a href="register.php">Register</a>
        </p>
    </div>

</body>
</html>
