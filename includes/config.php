<?php

$dbHost = 'localhost';
$dbPort = 5432;
$dbName = 'test2';
$dbUser = 'postgres';
$dbPass = 'FaLLaCY95!SQL';

$con = pg_connect("host=$dbHost port=$dbPort dbname=$dbName user=$dbUser password=$dbPass");

if($con == true){
    echo "The database is connected";
}

if(isset($_POST['submit'])){
    $uname = $_POST['usersname'];
    $pword = $_POST['password'];


    $query = pg_query($con, "INSERT INTO useracct(user_name, pass_word) VALUES ('$uname', '$pword');");
    if($query){
        echo "Record successfully added";
    }

}



?>

