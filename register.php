<?php

require "./includes/config.php";


$username = $password = $password2 = "";
$username_err = $password_err = $password2_err = "";

if (isset($_POST['submit'])) {
    //This refers to the name of an input.
    if (empty(trim($_POST["username"]))) {
        //This will display an error if the user fails to display a name
        $username_err = "Please enter a username";
    } else {
        //This is a database query; Will utilize a prepare and execute.
        $sql = "SELECT * FROM useracct WHERE user_name = :username";

        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            //The bind basically is replacing the paramater with a real value.
            //$param_username should be coming from a form below.
            //PDO::PARAM_STR = Represents the SQL CHAR, VARCHAR, or other string data type.

            $param_username = trim($_POST["username"]);

            if ($stmt->execute()) {
                //If there is a row, the username already exists in the database.
                if ($stmt->rowCount() == 1) {
                    $username_err = "This username is already taken";
                } else {
                    $username = trim($_POST["username"]);
                }
            }
        } else {
            echo "Oops! Something went wrong. Please try again later";
        }

        unset($stmt);
    }

    //Password Validation
    //Check if there is a password entered
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password";
        //Checks if the password is at least 6 characters
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have atleast 6 characters \n";
        //Removes the whitespace in the entered password;
    } else {
        $password = trim($_POST["password"]);
    };

    //Validate Password2
    if (empty(trim($_POST["password2"]))) {
        $password2_err = "Please enter confirm password\n";
    } else {
        $password2 = trim($_POST["password2"]);
        if (empty($password_err) && ($password != $password2)) {
            $password2_err = "Passwords did not match";
        }
    }

    //Preparing an insert statement.
    if (empty($username_err) && empty($password_err) && empty($password2_err)) {
        $sql = "INSERT INTO useracct(user_name, pass_word) VALUES (:username,:password)";

        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);

            //Set the parameters here
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if ($stmt->execute()) {
                header("location: register.php");
            } else {
                echo "Something went wrong. Please try again later.";
            }

            //Close statement
            unset($stmt);
        }
    }
    unset($pdo);
}

?>

<?php
include_once('header.php');
?>


<div id="login" class="fullWidth leftAlignText  centerFlex">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="pad2em blBorder">
        <h2 class="centerText">Register</h2>
        <p>Username</p>
        <input type="text" name="username" value="<?php echo $username;  ?>">
        <?php echo $username_err; ?>
        <p>Password</p>
        <input type="password" name="password">
        <?php echo $password_err; ?>
        <p>Confirm Password</p>
        <input type="password" name="password2">
        <?php echo $password2_err; ?>
        <input type="submit" name="submit" value="submit" class="submitBtn" />
        <a href="./login.php">Already have an account? Click here</a>
    </form>
</div>
</main>
</body>

</html>
<?php
