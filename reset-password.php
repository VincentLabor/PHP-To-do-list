<?php
include "./header.php";
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
};

require "./includes/config.php";

$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty(trim($_POST["new_password"]))) {
        $new_password_err = "Please enter a password";
    } else if (strlen(trim($_POST["new_password"])) < 6) {
        $new_password_err = "Please enter a password longer than 6 characters";
    } else {
        $new_password = trim($_POST["new_password"]);
    }

    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm the password";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        //If there are no errors and the confirmed password does not match, send err message.
        if (empty($confirm_password_err) && $new_password !== $confirm_password) {
            $confirm_password_err = "Confirmed password did not match";
        }
    }

    //Make sure there are no errors involved
    if (empty($new_password_err) && empty($confirm_password_err)) {
        $sql = "UPDATE useracct SET pass_word = :password WHERE id=:id";

        if ($stmt = $pdo->prepare($sql)) {

            $stmt->bindParam(":password", $param_new_password, PDO::PARAM_STR);
            $stmt->bindParam(":id", $param_id, PDO::PARAM_STR);

            $param_new_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];

            if ($stmt->execute()) {
                //password updates and redirects user to login page.
                header("location: login.php");
            } else {
                echo "An error has occured. Please try again later. ";
            }

            unset($stmt);
        }
    }
    //This is to cut the connection completely.
    unset($PDO);
}

?>




<div id="login" class="fullWidth leftAlignText  centerFlex">
    <form action="" method="POST" class="pad2em blBorder">

        <h2 class="centerText">Reset password</h2>

        <p>New password</p>
        <input type="password" name="new_password" value="<?php ?>">
        <?php echo $new_password_err; ?>
        <p>Confirm Password</p>
        <input type="password" name="confirm_password">
        <?php echo $new_password_err; ?>
        <input type="submit" name="submit" value="submit" class="submitBtn" />
        <a href="./welcome.php">Cancel</a>
    </form>
</div>
</main>
</body>

</html>