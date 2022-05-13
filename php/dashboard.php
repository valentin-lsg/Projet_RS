<?php 
session_start();

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

// Commentaire
// faire une fonction avec ça dedans pour l'utiliser partout checkLogin();
include("fonctionsPHP.php");

checkLogin();


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
    <a href="profil_setting.php">Ajouter une photo de profil</a>
    <br>
    <!-- <a href="profil_setting.php">Ajouter une bannière</a> -->

    <a href="deconnexion.php">Se deconnecter</a>
</body>
</html>