<?php
    $insert = false;
    // script will only get executed upon posting name
    if(isset($_POST['name'])) {
        
        // Set connection variables
        $server = "localhost";
        $username = "root";
        $password = "";
        
        // Establishing connection to DB
        $con = mysqli_connect($server, $username, $password);

        // Check for connection success
        if(!$con) {
            die("Connection to DB failed: " . mysqli_connect_error());
        }
        // echo "Successfully connected to DB!";

        // Insert values from POST into DB
        $name = $_POST['name'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $descr = $_POST['descr'];

        // Execute SQL query
        $sql = "INSERT INTO `participant_DB` . `participants` (`Serial No.`, `Date`, `name`, `age`, `gender`, `email`, `number`,`descr`) 
                VALUES (NULL, CURRENT_TIMESTAMP, '$name', '$age', '$gender', '$email', '$number', '$descr')";
        // echo $sql;

        // -> Obj. op.
        if($con->query($sql) == true) {
            // echo "Successfully inserted!";
            $insert = true; // Flag for successful insertion
        }
        else {
            echo "Error: $sql <br> $con->error";
        }

        // Close connection to DB
        $con->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WID Form</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- <img class="bg-bg" src="bg-bg.png" alt=""> -->
    <div class="container">
    
        <h3>Welcome To WID</h3>
        <p>Enter your details to participate</p>
        <?php 
            if($insert == true) {
                echo "<p class='submit-msg'>Form submitted successfully!!</p>";
            }
        ?>
        <!-- post(more secure): used in form submission to send passwords,etc. -->
        <!-- get(used to query in pg, e.g. search results): data sent using GET is displayed on URL -->
        <form action="index.php" method="post">
            <input type="text" name="name" id="name" placeholder="Enter Your Name">
            <input type="text" name="age" id="age" placeholder="Enter Your Age">
            <input type="text" name="gender" id="gender" placeholder="Enter Your Gender">
            <input type="email" name="email" id="email" placeholder="Enter Your Email">
            <input type="number" name="number" id="number" placeholder="Enter Your Phone Number">
            <textarea name="descr" id="descr" cols="30" rows="5" placeholder="Enter your description..."></textarea>
            <br>
            <button class="btn">Submit</button>
            <button class="btn">Reset</button>
        </form>
    </div>

    <script src="script.js"></script>
   
</body>
</html>