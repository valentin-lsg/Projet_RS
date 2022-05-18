<?php 
session_start();
include("fonctionsPHP.php");

$idDuPost = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if($idDuPost){
    require("../pdo/pdo.php");
    $marequete = $pdo->prepare("SELECT * FROM commentary");
    $marequete->execute();
    $commentaire = $marequete->fetchAll(PDO::FETCH_ASSOC);
    
    $idDeCeluiQuiACommente = $commentaire["user_id"];
    $marequete = $pdo->prepare("SELECT * FROM users where id=:id");
    $marequete->execute([
        ":id" => $idDeCeluiQuiACommente
    ]);
    $nomUtilisateur = $marequete->fetchAll(PDO::FETCH_ASSOC);


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
                    <td><?= $nomUtilisateur["username"] ?></td>
                    <td><?= $valueInCommentaire["text"] ?></td>
                    <!-- <td>  /* $valueInCommentaire["reaction"] */ </td> -->
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="dashboard.php">Retour</a>
</body>
</html>

