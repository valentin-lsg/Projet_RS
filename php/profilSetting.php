<?php 
session_start();
include("fonctionsPHP.php");


if($_SERVER["REQUEST_METHOD"] == "POST"){

    $laNouvelleDescription = filter_input(INPUT_POST, "description");
    $changementEffectue = 0;
    if(isset($_FILES['profilPicture'])){
        uploadMaPhoto();  
        $changementEffectue++;
    };
    
    if(isset($_FILES['banner'])){
        uploadMaBanniere();
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
    <title>Document</title>
</head>
<body>

        
      <form method="post" action="" enctype="multipart/form-data">

                <!-- Changer ma photo de profil -->
                <p>
                    <h1>Formulaire photo profil</h1>
                    <input type="file" name="profilPicture"><br>
                </p>
                <br>

                <!-- Changer ma bannière -->
                <p>
                    <h1>Formulaire banniere</h1>
                    <input type="file" name="banner"><br>
               </p>
               <br>

               <!-- Changer la description -->
               <p>
                   <h1>Formulaire description</h1>
                   <input type="text" name="description" ><br>
               </p>

               <!-- Bouton d'envoi -->
            <button type="submit">Enregistrer les changements</button>
        </form>

        <br>
        
    <a href="deconnexion.php">Se deconnecter</a>
    <br>
    <a href="dashboard.php">Retour</a>
</body>
</html>