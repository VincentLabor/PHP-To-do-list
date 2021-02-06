<?php
include_once('header.php');
include "./includes/config.php";
session_start();

$task = $complete = $user_associated = "";
        $task_err = $complete_err = $user_associated_err = "";

        if (isset($_POST['submit'])) {
            if (empty(trim($_POST["task"]))) {
                $task_err = "Please enter a task";
            } else {
                $task = trim($_POST["task"]);
            }

            if (empty($task_err)) {
                $sql = "INSERT INTO tasklist(task) VALUES (:task)";

                if ($stmt = $pdo->prepare($sql)) {
                    $stmt->bindParam(":task", $param_task, PDO::PARAM_STR);

                    $param_task = $task;

                    if ($stmt->execute()) {
                        header("location: welcome.php");
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


<div id="login" class="fullWidth leftAlignText  centerFlex">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="pad2em blBorder">
        <h3>To Do List</h3>
        <p>
            <?php
            include "./includes/config.php";
            //Through each iteration, each value of the element is set to $row.
            //Next to each row is a checkbox concatenated. 
            foreach ($pdo->query('SELECT * FROM tasklist') as $row) {
                print nl2br($row['task'] . '<input type="checkbox" name="" id="">' . "\n");
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