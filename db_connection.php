<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


$servername = "localhost";  
$username = "root";         
$password = "";             
$dbname = "career_predictor"; 


$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    
    die("Connection failed: " . mysqli_connect_error());
}


echo "Connected successfully to the database.";
?>
