<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>

    <?php
    echo "<link rel='stylesheet' type='text/css' href='./styles.css?v=<?php echo time(); ?>'>";
    ?>

</head>

<?php

require_once "./includes/config.php";

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     if(empty(trim($_POST["username"]))){
//         $username_err = "Please enter a username."; 
//     } else {
//         $sql = "SELECT id FROM useracct WHERE username=?";

//     }
// }

?>

<body>
    <main>

        <h1 class="red">
            Greetings
        </h1>
        <div id="login" class="fullWidth leftAlignText  centerFlex">

            <form action="" method="POST" class="pad2em blBorder">
                <h2 class="centerText">Register</h2>
                <p>Username</p>
                <input type="text" name="usersname">
                <p>Password</p>
                <input type="text" name="password">
                <!-- <p>Confirm Password</p>
                <input type="text"> -->
                <!-- <input type="submit" class="submitBtn"></input> -->
                <input type="submit" name="submit" value="submit" class="submitBtn"/>
            </form>


        </div>
    </main>
</body>

</html>

<?php

// echo  phpinfo(); 

// $db = pg_connect("host=localhost port=5432 dbname=test user=postgres password=FaLLaCY95!SQL");
// if ($db == true){
//     echo "The database is connected\n";
// }

// $query = "SELECT * FROM useracct";
// $rs = pg_query($db, $query) or die("Cannot execute query: $query\n");

// while ($row = pg_fetch_row($rs)) {
//     echo "$row[0] $row[1] $row[2] $row[3] $row[4] <br/>";
// }

// pg_close($db);

?>