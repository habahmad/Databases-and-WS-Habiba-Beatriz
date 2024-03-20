<?php

$dsn = "mysql:host=localhost;dbname=grandlineuni"; 
$username = "root";
$password = ""; 


//helps catch any potential errors
try {
    //php data object
    $pdo = new PDO($dsn, $username, $password);
    //error handling
    $pdo->setAttribute(PDO :: ATTR_ERRMODE, PDO :: ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();  
}

/*
//$servername = "localhost";
//$dbname = "grandlineuni"; 
// Creating connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Checking connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

*/