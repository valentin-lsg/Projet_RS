<?php 
session_start();

include("fonctionsPHP.php");

checkLogin();

/* Création d'une publication */
$boutonEnvoiMonPost = filter_input(INPUT_POST, "boutonEnvoiMonPost");
$titrePublication = filter_input(INPUT_POST, "titrePublication");
$textePublication = filter_input(INPUT_POST, "textePublication");

if(isset($boutonEnvoiMonPost)){
    $monCheminImage = uploadMaPhoto("imagePublication", "post");
    if($monCheminImage != "Erreur, votre photo n'a pas été upload."){
        if($titrePublication && $textePublication){
            creerUnePublication($monCheminImage, $textePublication, $titrePublication); 
        }
        
    };
    
};




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
    <style>
        * {
            box-sizing: border-box;
            }

            /* Create two equal columns that floats next to each other */
        .column {
        float: left;
        width: 50%;
        padding: 10px;
        height: 300px; /* Should be removed. Only for demonstration */
        }

        /* Clear floats after the columns */
        .row:after {
        content: "";
        display: table;
        clear: both;
        }
    </style>

    <style>
    .maPublication {
    width: 320px;
    padding: 10px;
    border: 5px solid gray;
    margin: 0;
    }
    </style>

    <div class="row">
        <div class="column">
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

            <form action="" method="post" enctype="multipart/form-data">

                <label for="titrePublication">Titre de ma publication :</label><br>
                <input type="text" name="titrePublication">
                <br>

                <label for="textePublication">Texte de ma publication :</label><br>
                <textarea style="resize:none" name="textePublication"  cols="30" rows="10"></textarea>
                <br>

                <label for="imagePublication">Joindre une image</label>
                <input name="imagePublication" type="file">
                <br>

                <button name="boutonEnvoiMonPost" type="submit">Envoyer</button>
                <br>

            </form>

            <!-- Ajouter sa photo de profil -->
            <a href="profilSetting.php">Editer mon profil</a><br>
            <a href="personnalSetting.php">Editer vos infos persos</a><br>  
            <a href="deconnexion.php">Se deconnecter</a>
        </div>
        <!-- Contenu :
            ETAPE 1 : Créer une publication apparaissant sur son profil
            ETAPE 2 : Commenter une publication ou un autre commentaire (un niveau maximum)
            ETAPE 3 : Réagir à une publication ou un commentaire avec un émoji -->
            <!-- maPublication -->

        <div class="column">
            
        <?php 
            afficherMesPublications();
            
        ?>
        

        </div>
    </div>
</body>
</html>