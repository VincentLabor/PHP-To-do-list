<?php
include_once('header.php');
require "./includes/config.php";

session_start();

$task = $complete = $user_associated = "";
$task_err = $complete_err = $user_associated_err = "";

echo $_SESSION["username"];

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
                echo "Task has been sent";
            } else {
                echo "There has been a problem. Please wait a moment and try again later.";
            }
            unset($stmt);
        }
    }
    unset($pdo);
}

//Checkbox should only be displayed when the whole tasklist is being displayed. 

?>

<h1><a href="./logout.php">Click here to log out</a></h1>


<div id="login" class="fullWidth leftAlignText  centerFlex">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="pad2em blBorder">
        <h3>To Do List</h3>
        <p>
            <?php

                foreach($pdo->query('SELECT * FROM tasklist') as $row){
                    print $row['task'] . "\t";
                }

                // $stmt = $pdo->prepare('SELECT * FROM tasklist');
                // if($stmt->execute()){
                //     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                //     print_r($result);
                // }
            ?>
        </p>
        <input type="text" name="task">
        <button type="submit" name="submit">Add Task</button>
    </form>
</div>
</main>
</body>

</html>