<?php
include_once('header.php');
require "./includes/config.php";
//Initializes the start
session_start();

//Check if user us already logged in. Will redirect if so. 
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    header("location:welcome.php");
    exit;
}

$username = $password = "";
$username_error = $password_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Validate the username
    if (empty(trim($_POST["username"]))) {
        $username_error = "Please enter a username";
    } else {
        $username = trim($_POST["username"]);
    }

    //Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_error = "Please enter a password";
    } else {
        $password = trim($_POST["password"]);
    }

    //If there are no errors, prepare and execute. 
    if (empty($password_error) && empty($username_error)){
        $sql = "SELECT id, user_name, pass_word FROM useracct WHERE user_name = :username";

        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $param_username = trim($_POST["username"]);

            if($stmt->execute()){
                //Check if username exists
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $username = $row["user_name"];
                        $hashed_password = $row["pass_word"];
                        if(password_verify($password, $hashed_password)){
                            session_start();
    
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
    
                            header("location: welcome.php");
                        } else {
                            $password_error = "The password you entered is incorrect";
                        }
                    }
                } else {
                    $username_error = "Username does not exist.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            //close statement
            unset($stmt);
        }
    }
    unset($pdo);
}




?>
<div id="login" class="fullWidth leftAlignText  centerFlex">
    <form action="" method="POST" class="pad2em blBorder">
        <h2 class="centerText">Login</h2>
        <p>Username</p>
        <input type="text" name="username" value="<?php echo $username ?>">
        <?php echo $username_error; ?>
        <p>Password</p>
        <input type="password" name="password">
       <p class="red"> <?php echo $password_error; ?></p>
        <input type="submit" name="submit" value="submit" class="submitBtn" />
        <a href="./register.php">Don't have an account? Sign up here.</a>
    </form>
</div>
</main>
</body>

</html>