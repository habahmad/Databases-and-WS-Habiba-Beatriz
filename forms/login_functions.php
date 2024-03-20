<?php 

declare(strict_types=1);  

//checks if user exists inside the database and matches passwords 
function get_user(object $pdo, string $username){
    $query = "SELECT * FROM users WHERE username = ':username'";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    return $results;
} 

//checks if user exists inside the database and matches passwords 
function username_wrong(bool | array $results){
    if (!$results){
        //didn't find user inside database
        return True;
    }else{
        //user does exist and passwords matched
        return False;
    }
}

function pass_wrong(string $pass, string $password_hash){
    if (!password_verify($pass,$password_hash)){
        //wrong password entered
        return True;
    }else{
        //correct password entered
        return False;
    }
}

function input_empty(string $username, string $pass){
    if(!empty($username) && !empty($pass)){
        return False; 
    }else {
        return True;
    }
}
