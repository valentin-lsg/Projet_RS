<?php 
session_start();

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

// Commentaire
if(!isset($_SESSION["username"])) { 
    http_response_code(302);
    header('Location: login.php');
    exit();
} 

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    echo "<h1> ma page dashboard </h1>"
    ?>
    <a href="deconnexion.php">Se deconnecter</a>
</body>
</html>