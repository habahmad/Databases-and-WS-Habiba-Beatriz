<?php
session_start();
    //checks if user is logged in or not
    //will be used in pages which a user can't access unless logged in
    $_SESSION;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My website</title>
</head>
<body>

    <a href="logout.php">Logout</a>
    <h1> This is the index page </h1>
    <br>
    Hello, Username.
</body>
</html>