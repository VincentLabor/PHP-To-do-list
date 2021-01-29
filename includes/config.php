<?php

$dbHost = 'localhost';
$dbPort = 5432;
$dbName = 'test2';
$dbUser = 'postgres';
$dbPass = 'FaLLaCY95!SQL';

$dsn = "pgsql:host=$dbHost;port=$dbPort;dbname=$dbName;user=$dbUser;password=$dbPass";

try{
 //connection string   
$pdo = new PDO($dsn);
if($pdo){
    // print "We are connected";
}
} catch (PDOException $e){
    // report error message
    die("Error: Could not connect." . $e->getMessage());
   }

// $con = pg_connect("host=$dbHost port=$dbPort dbname=$dbName user=$dbUser password=$dbPass");

// if (isset($_POST['submit'])) {
//     $uname = $_POST['usersname'];
//     $pword = $_POST['password'];

//     if (empty(trim($_POST['usersname']))) {
//         $username_err = "Please enter a username";
//          echo '<p>Please enter a username</p>';

//         // echo '<script language="javascript">';
//         // echo 'alert("Please enter a username")';
//         // echo '</script>';
    
//     } else if (empty(trim($_POST['password']))) {
//         $password_err = "Please enter a password";
//         echo '<p>Please enter a password</p>';
//     } else {

//         $sqlUname = "SELECT * FROM useracct WHERE user_name=$1";

//         $result = pg_prepare($con, "my_query", $sqlUname);
//         $result = pg_execute($con, "my_query", array($uname));
        

//         $query = pg_query($con, "INSERT INTO useracct(user_name, pass_word) VALUES ('$uname', '$pword');");
//         if ($query) {
//             echo "Record successfully added";
//         }
//     }
// }