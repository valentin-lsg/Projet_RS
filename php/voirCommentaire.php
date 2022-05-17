<?php 
session_start();
include("fonctionsPHP.php");

$idDuPost = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if($idDuPost){
    require("../pdo/pdo.php");
    $marequete = $pdo->prepare("SELECT * FROM commentary");
    $marequete->execute();
    $commentaire = $marequete->fetchAll(PDO::FETCH_ASSOC);

}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commentaire</title>
</head>
<body>
<table>
        <thead>
            <tr>
                <th>User_ID</th>
                <th>Texte</th>
                <th>Reaction</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($commentaire as $valueInCommentaire): ?>
                <tr>
                    <td><?= $valueInCommentaire["user_id"] ?></td>
                    <td><?= $valueInCommentaire["text"] ?></td>
                    <td><?= $valueInCommentaire["reaction"] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="dashboard.php">Retour</a>
</body>
</html>

