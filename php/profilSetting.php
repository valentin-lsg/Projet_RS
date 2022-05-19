<?php 
session_start();
include("fonctionsPHP.php");


if($_SERVER["REQUEST_METHOD"] == "POST"){

    $laNouvelleDescription = filter_input(INPUT_POST, "description");
    $changementEffectue = 0;
    if(isset($_FILES['profilPicture'])){
        uploadMaPhoto('profilPicture' ,"profil");  
        $changementEffectue++;
    };
    
    if(isset($_FILES['banner'])){
        uploadMaBanniere();
        /* fonction qui créer une balise image dans la div "photo" */
        $changementEffectue++;
    };
    
    if($laNouvelleDescription){
        changeDescriptionUser($laNouvelleDescription);
        $changementEffectue++;
    };
    
    if($changementEffectue>0){
        echo '<center>Les changements ont été effectués.</center>';
    };
    
}

checkLogin();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le profil</title>
    <link rel="stylesheet" href="../Page HTML/editProfil.css">
</head>
<body>

    <img class="displayed" src="../PAGE HTML/image/testhibou3.png">
    <div id="page">
      
    <form method="post" action="" enctype="multipart/form-data">
        <text id="editPhoto">Modifier la photo de profil</text>

        <div><img id="photo" src="" alt=""></div> <!-- Afficher l'image qui a été chargée. -->

        
        <input id="openPhoto" type="file" name="profilPicture">
            

        <!-- <button id="openPhoto">Choisir un fichier</button> -->
        <text id="editBanner">Modifier la bannière de profil</text>

        <div id="banner"></div>

        <input id="openBanner" type="file" name="banner">  

        <!-- <button id="openBanner">Choisir un fichier</button> -->
        <text id="editBiography">Modifier la biographie</text>   

        <textarea name="description"  id="writeBiography" placeholder="Biographie" size="20" maxlength="200"></textarea>
        
        <button type="submit" id="saveBiography">Enregistrer</button>
    </form>
        
      
              
      <a href="dashboard.php">Retour</a>
    
    
    
    </div>
    
    
</body>
</html>

