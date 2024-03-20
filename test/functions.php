<?php

//checks if session value and user exists 
//to make sure the login is legitimate
function check_login($pdo){
    if(isset($_SESSION['user_id'])){
        
        require_once "connect.php";

        $id = $_SESSION['user_id'];
        $query = "SELECT * FROM users where uID = '$id' limit 1;";

        $stmt = $pdo->prepare($query);
        $stmt->execute();            
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($results as $rows){
            if($results && $rows>0){
                return $results;
            }
        }
    }else{
        //redirected back to login page
        header("Location : login.html");
    }
    
}