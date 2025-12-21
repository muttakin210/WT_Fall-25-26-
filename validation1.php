<html>
<head>
    <title>valodation</title>
</head>
<body>
    <h1>Email validation</h1>
    
    <?php 
    $email = "";
    $emailerror = "";


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["email"])) {
            $emailerror = "Email cannot be empty";
        } else {
            $email = text_input($_POST["email"]);
            

           if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/", $email)) {
                $emailerror = "Please enter a valid email address (e.g., anything@example.com).";
            }
        }
    }

    function text_input($data) {
        return trim($data);
    }
    ?>

    <form method="post" action="">
        <fieldset>
            <legend>Email</legend>
            <input type="text" name="email" value="<?php echo $email ; ?>">

            <span style="color:red"><?php echo $emailerror; ?></span>
            <br><br>

            <input type="submit" value="Submit">
        </fieldset>
    </form>

    <?php 

    if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($emailerror)) {
        echo "<br>The Email is: " . $email;
    }
    ?>
</body>
</html>