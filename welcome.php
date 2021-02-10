<?php
include_once('header.php');
include "./includes/config.php";
session_start();

$task = $complete = $task_complete = $user_associated = "";
$task_err = $complete_err = $task_complete_error = $user_associated_err = "";

if (isset($_POST['submit'])) {
    if (empty(trim($_POST["task"]))) {
        $task_err = "Please enter a task";
    } else {
        $task = trim($_POST["task"]);
    }

    if (empty($task_err)) {
        //We are going to bind both the task and user who submitted the task.
        $sql = "INSERT INTO tasklist(task, user_associated) VALUES (:task, :associated)";

        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":task", $param_task, PDO::PARAM_STR);
            $stmt->bindParam(":associated", $param_user_associated, PDO::PARAM_STR);

            $param_task = $task;
            $param_user_associated = $_SESSION["username"];

            if ($stmt->execute()) {
                // header("location: welcome.php");
            } else {
                //For some reason stmt fails but still works?
                echo "There has been a problem. Please wait a moment and try again later.";
            }
            unset($stmt);
        }
    }
    unset($pdo);
}

?>

<h1><a href="./logout.php">Click here to log out</a></h1>
<h1><a href="./reset-password.php">Click here to change your password</a></h1>


<div id="login" class="fullWidth leftAlignText  centerFlex">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="pad2em blBorder">
        <h3>To Do List</h3>
        <p>
            <?php
            include "./includes/config.php";

            $user = $_SESSION["username"];
            //Through each iteration, each value of the element is set to $row.
            //Next to each row is a checkbox concatenated. 
            $sql = "SELECT * FROM tasklist where user_associated = :usernames";
            if ($stmt = $pdo->prepare($sql)) {
                $stmt->bindParam(":usernames", $param_usernames, PDO::PARAM_STR);
                $param_usernames = $_SESSION['username'];
                $query_process = ($pdo->query("SELECT * FROM tasklist where user_associated = '$user'"));
                if ($stmt->execute()) {
                    foreach ($query_process as $row) {
                        print nl2br($row['task'] . '<input type="checkbox" name="task_compl" id="">' . "\n");
                    }
                } else {
                    echo "An error has occured. Please try again later.";
                }
            }

            ?>
        </p>

        <input type="text" name="task">
        <button type="submit" name="submit">Add Task</button>

        <!-- PHP: Check if task has been sent properly -->

        <?php
        include "./includes/config.php";
        ?>


    </form>
</div>
</main>
</body>

</html>


<!-- 'SELECT * FROM tasklist WHERE user_associated ="' . $user . '" ' -->