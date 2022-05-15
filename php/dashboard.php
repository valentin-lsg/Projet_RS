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

    <h2>Mes publications :</h2>
    <h3>Créer une publication</h3>

    <?php
        $boutonEnvoiMonPost = filter_input(INPUT_POST, "boutonEnvoiMonPost");
        $textePublication = filter_input(INPUT_POST, "textePublication");
        
    
        if(isset($boutonEnvoiMonPost)){
            if($textePublication){
                echo $textePublication;
            };

            uploadMaPhoto("imagePublication", "post");
            
        };
    ?>

    <form action="" method="post" enctype="multipart/form-data">

        <label for="textePublication">Texte de ma publication :</label><br>
        <textarea style="resize:none" name="textePublication"  cols="30" rows="10"></textarea>
        <br>

        <label for="imagePublication">Joindre une image</label>
        <input name="imagePublication" type="file" name="">
        <br>

        <button name="boutonEnvoiMonPost" type="submit">Envoyer</button>
        <br>

    </form>
    <!-- Contenu :

    ETAPE 1 : Créer une publication apparaissant sur son profil
    ETAPE 2 : Commenter une publication ou un autre commentaire (un niveau maximum)
    ETAPE 3 : Réagir à une publication ou un commentaire avec un émoji

    -->




    <!-- Ajouter sa photo de profil -->
    <a href="profilSetting.php">Editer mon profil</a><br>
    <a href="personnalSetting.php">Editer vos infos persos</a><br>  
    <a href="deconnexion.php">Se deconnecter</a>
</body>
</html>