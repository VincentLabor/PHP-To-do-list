<?php 
session_start();


//unset all session variables
$_SESSION = array();

//Destroy session
session_destroy();

header("location: login.php");



?>