<?php

require "./includes/config.php";


$username = $password = $password2 = "";
$username_err = $password_err = $password2_err = "";

if (isset($_POST['submit'])) {
    if (empty(trim($_POST["usersname"]))) {
        $username_err = "Please enter a username";
        // echo "Please enter a username";
    } else {
        $sql = "SELECT * FROM useraccts WHERE user_name = :usersname";

        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":usersname", $param_username, PDO::PARAM_STR);
            //PDO::PARAM_STR = Represents the SQL CHAR, VARCHAR, or other string data type.
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>

    <?php
    echo "<link rel='stylesheet' type='text/css' href='./styles.css?v=<?php echo time(); ?>'>";
    ?>
    <script type="text/javascript" src="./app.js"></script>
</head>


<body>
    <main>

        <h1 class="red">
            <a href="/"> Greetings</a>

        </h1>
        <div id="login" class="fullWidth leftAlignText  centerFlex">

            <form action="" method="POST" class="pad2em blBorder">
                <h2 class="centerText">Register</h2>
                <p>Username</p>
                <input type="text" name="usersname">
                <p>Password</p>
                <input type="password" name="password">
                <p>Confirm Password</p>
                <input type="password" name="password2">

                <input type="submit" name="submit" value="submit" class="submitBtn" />
                <?php
                echo $username_err;
                ?>
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