<?php 
session_start();
include("fonctionsPHP.php");
gererMonCompte();
$userInfos = fromTableUsers();

// Pour éviter que les comptes actifs puissent accéder à cette page.
if($userInfos["account_state"] != 1){
    http_response_code(302);
    header('Location: profil.php');
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compte inactif</title>
</head>
<body>
    <?= '<span>Le compte de '.$_SESSION["username"].' est désactivé.<span><br>'; ?>
    <form action="" method="post">
        <button name="reactiverCompte" type="submit">Réactiver le compte</button><br>
    </form>
    <a href="index.php">Retour au login</a>
</body>
</html>