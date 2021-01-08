<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>

    <?php
    echo "<link rel='stylesheet' type='text/css' href='./styles.css?v=<?php echo time(); ?>'>"
    ?>

</head>

<body>
    <main>

        <h1 class="red">
            Greetings
        </h1>
        <div id="login" class="fullWidth leftAlignText  centerFlex">

            <form action="get" class="pad2em blBorder">
                <h2 class="centerText">Register</h2>
                <p>Email</p>
                <input type="text" class="">
                <p>Password</p>
                <input type="text" class="">
                <p>Confirm Password</p>
                <input type="text" class="">
                <button type="submit" class="submitBtn"> Register</button>
            </form>


        </div>
    </main>
</body>

</html>