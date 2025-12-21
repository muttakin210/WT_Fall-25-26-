<html>
<head>
    <title>Validation</title>
</head>
<body>
    <h1>Date Validation</h1>
    
    <?php 
    $day = $month = $year = "";
    $dateerror = "";




    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $day = text_input($_POST["day"]);
        $month = text_input($_POST["month"]);
        $year = text_input($_POST["year"]);

       
       
        if (empty($day)||empty($month)||empty($year)) {

            $dateerror = "All fields are required.";
        } elseif (!is_numeric($day)||!is_numeric($month)||!is_numeric($year)) {

            $dateerror = "Day, Month, and Year must be valid numbers.";
        } else {


            $day = (int)$day;
            $month = (int)$month;
            $year = (int)$year;





            if ($day < 1 || $day > 31) {
                $dateerror = "Day must be between 1 and 31.";
            } elseif ($month < 1 || $month > 12) {
                $dateerror = "Month must be between 1 and 12.";
            } elseif ($year < 1953 || $year > 1998) {
                $dateerror = "Year must be between 2000 and 2008.";
            } else {
                if (!checkdate($month, $day, $year)) {
                    $dateerror = "Please enter a valid date.";
                }
            }
        }
    }

    function text_input($data) {
        return trim($data);
    }
    ?>

    <form method="post" action="">
        <fieldset>
            <legend>Date of Birth</legend>
            dd: <input type="text" name="day" value="<?php echo $day; ?>" size="2">/
            mm: <input type="text" name="month" value="<?php echo $month; ?>" size="2">/
            yyyy: <input type="text" name="year" value="<?php echo $year; ?>" size="4">
            <br><br>
            <span style="color:red"><?php echo $dateerror; ?></span>
            <br><br>
            <input type="submit" value="Submit">
        </fieldset>


    </form>

    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($dateerror)) {
        echo "<br>The Date of Birth is: " . $day . "-" . $month . "-" . $year;
    }
    ?>
</body>
</html>