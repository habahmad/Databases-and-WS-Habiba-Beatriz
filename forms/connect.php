<?php
//import project's sql file into php my admin
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
