<?php 
session_start();

/* $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
 */
include("fonctionsPHP.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if(isset($_POST['profilPicture'])){
        uploadMaPhoto();  
    }else if(isset($_POST['banner'])){
        uploadMaBanniere();
    }
    
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

        <!-- Changer ma photo de profil -->
      <form method="post" action="" enctype="multipart/form-data">
                <p>
                    <h1>Formulaire photo profil</h1>
                    <input type="file" name="profilPicture"><br>
                    <button name="profilPicture" type="submit">Envoyer ma photo</button>
                </p>

        </form>

        <br>
        <!-- Changer ma bannière -->
        <form method="post" action="" enctype="multipart/form-data">
                <p>
                    <h1>Formulaire banniere</h1>
                    <input type="file" name="banner"><br>
                    <button name="banner" type="submit">Envoyer ma banniere</button>
                </p>

        </form>

    <a href="deconnexion.php">Se deconnecter</a>
    <br>
    <a href="dashboard.php">Retour</a>
</body>
</html>