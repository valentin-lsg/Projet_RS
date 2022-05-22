<?php 
session_start();
include("fonctionsPHP.php");

$idDuPost = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if($idDuPost){
    require("../pdo/pdo.php");
    $marequete = $pdo->prepare("SELECT * FROM commentary where post_id=:post_id");
    $marequete->execute([
        ":post_id" => $idDuPost
    ]);
    $commentaire = $marequete->fetchAll(PDO::FETCH_ASSOC);
    


}

function quiCommente($idDeCeluiQuiACommente){
    require("../pdo/pdo.php");
    $marequete = $pdo->prepare("SELECT * FROM commentary where user_id=:user_id");
    $marequete->execute([
        ":user_id" => $idDeCeluiQuiACommente
    ]);
    $quiCommente = $marequete->fetch(PDO::FETCH_ASSOC);

    $marequete = $pdo->prepare("SELECT * FROM users where id=:id");
    $marequete->execute([
        ":id" => $idDeCeluiQuiACommente
    ]);
    $usernameDeCeluiQuiCommente = $marequete->fetch(PDO::FETCH_ASSOC);
    echo $usernameDeCeluiQuiCommente["username"];
    
}

   



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commentaire</title>
    <style>
        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
table {
    border: medium solid #000000;
    width: 50%;
    margin: 2% auto;
    }
td, th {
    border: thin solid white;
    width: 50%;
    }
    </style>
</head>
<body>
<table >
        <thead>
            <tr>
                <th>Nom de la personne</th>
                <th>Texte</th>
                <!-- <th>Reaction</th> -->
            </tr>
        </thead>
        <tbody>
            <?php foreach($commentaire as $valueInCommentaire): ?>
                <tr>
                    <td><?php $idDeCeluiQuiACommente = quiCommente($valueInCommentaire['user_id']);    ?></td>
                    <td><?= $valueInCommentaire["text"] ?></td>
                    <?php 
                        
                    ?>
                    <!-- <td>  /* $valueInCommentaire["reaction"] */ </td> -->
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="profil.php">Retour</a>
</body>
</html>

