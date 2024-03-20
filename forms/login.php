<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $pass = $_POST["pass"];

    try {
        require_once 'connect.php';
        require_once 'login_functions.php'; 

        //array of errors from website
        $err = [];

        //checks if all inputs have been filled 
        if(input_empty($username, $pass)){
            $err["emptyInput"] = "Enter input in required fields.";
        }

        //storing results from database query
        $results = get_user($pdo, $username); 

        //making sure the login information entered is correct and error handling if not
        if(username_wrong($results)){
            $err["username_wrong"] = "Wrong username entered!";
        }
        if(pass_wrong($pass, $results["password_hash"])){
            $err["password_wrong"] = "Wrong password entered!";
        }
        if($err){
            $_SESSION["errors_login"] = $err;
            header("Location: ../mainte.html");
            die();
        }

    } catch(PDOException $e){
        die("Query failed:" . $e->getMessage());
    }
}
else{
    header("Location: ../mainte.html");
    die();
}

?>

