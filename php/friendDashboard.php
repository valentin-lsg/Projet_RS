<?php 

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
include("fonctionsPHP.php");
require("../pdo/pdo.php");;

$maRequete = $pdo->prepare("SELECT * FROM profil WHERE user_id = :id");
// Etape 2 : J'exécute la requête
$maRequete->execute([
    ":id" => $id
]);
// Etape 3 : Je récupère LE résultat
$pageProfilDeMonAmi = $maRequete->fetch(PDO::FETCH_ASSOC);

$maRequete = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$maRequete->execute([
    ":id" => $id
]);
$infoDeMonAmi = $maRequete->fetch(PDO::FETCH_ASSOC);

$maRequete = $pdo->prepare("SELECT * FROM post WHERE user_id = :id");
$maRequete->execute([
    ":id" => $id
]);
$postDeMonAmi = $maRequete->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de <?= $infoDeMonAmi["username"]; ?></title>
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
            afficherMonUsername($infoDeMonAmi["username"]);
            ?>
            <br>

            <!-- Afficher son image de profil -->
            <p>Votre image de profil actuel est :</p>
            <?php 
            afficherMonImageDeProfil($infoDeMonAmi["id"]);
            ?>

            <!-- Afficher ma bannière -->
            <br>
            <p>Votre image de banniere actuel est :</p>
            <?php 
            afficherMaBanniere($infoDeMonAmi["id"]);
            ?>

            <!-- Afficher ma description -->
            <br>
            <p>Votre biographie est :</p>
            <?php 
            afficherMaBiographie($infoDeMonAmi["id"]);
            ?>


        </div>
        

        <div class="column">
        <?php 
        
            afficherMesPublications($infoDeMonAmi["id"]);
            
        ?>
        <br>
        <form method="GET">
        <input type="search" name="research" placeholder="Rechercher un membre">
        <input type="submit" value="recherche">
    </form>

    <a href="dashboard.php"></a>
        

        </div>
    </div>
</body>
</html>