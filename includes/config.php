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
