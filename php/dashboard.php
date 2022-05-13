<?php 
session_start();

/* $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
 */
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
    <a href="profil_setting.php">Editer mon profil</a>
    <br>

        <!-- ON DOIT POUVOIR MODIFIER TOUTES NOS INFOS PERSONNELS -->

    <!-- <a href="profil_setting.php">Modifier ma biographie</a> -->
    <br>
    <!-- <a href="profil_setting.php">Changer mon username</a> -->
    <br>
    <!-- <a href="profil_setting.php">Desactiver son compte</a> -->
    <br>
    <!-- <a href="profil_setting.php">Supprimer son compte</a> -->
    

    <a href="deconnexion.php">Se deconnecter</a>
</body>
</html>