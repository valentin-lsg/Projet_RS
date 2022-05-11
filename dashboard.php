<?php 
session_start();

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);


if(!isset($_SESSION["username"])) { 
    http_response_code(302);
    header('Location: login.php');
    exit();
} 

echo "<h1> ma page dashboard </h1>"
?> 

