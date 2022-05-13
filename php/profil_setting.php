<?php 
session_start();

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

include("fonctionsPHP.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    uploadMaPhoto();
    
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

        <!-- Comment upload mon fichier -->
      <form method="post" action="" enctype="multipart/form-data">
                <p>
                    <h1>Formulaire photo profil</h1>
                    <input type="file" name="profilPicture"><br>
                    <button type="submit">Envoyer ma photo</button>
                </p>

        </form>

    <a href="deconnexion.php">Se deconnecter</a>
    <br>
    <a href="dashboard.php">Retour</a>
</body>
</html>