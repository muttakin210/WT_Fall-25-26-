<html>
<head>
    <title>PHP validation code</title>
</head>
 
<body>
<h1>NAME</h1>
 
<?php
$name = "";

$nameerror = "";

 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    if (empty($_POST["name"])) {
        $nameerror = "Enter your Name";
    } else {
        $name = text_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameerror = "Please enter a valid name";
        }
    }
 
 
   
        
    
}
 
function text_input($data)
{
    return trim($data);
}
?>
 

    <form method="post" action="">
        <fieldset>
            <legend>Name</legend>
            <input type="text" name="name" value="<?php echo $name; ?>">

            <span style="color:red"><?php echo $nameerror; ?></span>
            <br><br>

            <input type="submit" value="Submit">
        </fieldset>
    </form>
 
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($nameerror) && empty($ageerror)) {
    echo "<br>The Name is : " . $name;
    
}
?>

 
</body>
</html>
 