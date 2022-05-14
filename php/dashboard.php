<?php 
session_start();

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

    <!-- Afficher mon username -->
    <p>Votre username :</p>
    <?php 
    afficherMonUsername();
    ?>
    <br>

    <!-- Afficher son image de profil -->
    <p>Votre image de profil actuel est :</p>
    <?php 
    afficherMonImageDeProfil();
    ?>

    <!-- Afficher ma bannière -->
    <br>
    <p>Votre image de banniere actuel est :</p>
    <?php 
    afficherMaBanniere();
    ?>

    <!-- Afficher ma description -->
    <br>
    <p>Votre biographie est :</p>
    <?php 
    afficherMaBiographie();
    ?>
    <br>

    <!-- Ajouter sa photo de profil -->
    <a href="profilSetting.php">Editer mon profil</a>
    <br>

    <a href="personnalSetting.php">Editer vos infos persos</a>
    <br>  

    <a href="deconnexion.php">Se deconnecter</a>
</body>
</html>