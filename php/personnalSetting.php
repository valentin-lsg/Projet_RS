<?php 
session_start();
include("fonctionsPHP.php");
checkLogin();

$userInfos = fromTableUsers();

changerInfoPerso($userInfos);
changePassword();


?>

<!-- Un gros formulaire avec toutes les données à changer -->
<!-- Demander puis vérifier si le mot de passe concorde avant de changer ses infos -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infos personnel</title>
</head>
<body>

    <!-- Afficher les infos de l'utilisateur depuis la base de donnée -->
    <section>
        <h2>Mes informations</h2>
        <span>Votre nom de famille : <?= $userInfos["lastname"]; ?></span><br>
        <span>Votre prénom : <?= $userInfos["name"] ?></span><br>
        <span>Votre Mail : <?= $userInfos["mail"] ?></span><br>
        <span>Pays : <?= $userInfos["country"] ?></span><br>
        <span>Date de naissance : <?= $userInfos["birthday"] ?></span><br>
        <span>Numéro de telephone : <?= $userInfos["phone"] ?></span><br>
        <span>Nom d'utilisateur : <?= $userInfos["username"] ?></span><br>

        <!-- Créer des fonctions pour ceci -->
        <button style="color:orange">Desactiver votre compte</button><br>
        <button style="color:red">Supprimer définitement votre compte</button>
    </section>

    <!-- Modifier les infos de l'utilisateur + confirmation avec mot de passe. -->
    <section>
        <h2>Changer mes informations</h2>
            <form action="" method="post">
                <label for="username">Nom d'utilisateur :</label>
                <input name="username" type="text"><br>

                <label for="lastname">Nom de famille :</label>
                <input name="lastname" type="text"><br>

                <label for="name">Prénom :</label>
                <input name="name" type="text"><br>

                <label for="mail">Adresse mail :</label>
                <input name="mail" type="email"><br>

                <label for="country">Pays :</label>
                <select name="country">
                    <?php include("select.php") ?>
                </select><br>

                <label for="date">Date de naissance :</label>
                <input name="birthday" min="1950-01-01" max="2020-12-31" type="date"><br>

                <label for="phone">Numéro de téléphone :</label>
                <input name="phone" type="number"><br>

                

                <br>
                <button type="submit">Enregistrer les changements</button>
            </form>
    
    </section>

    <section>
        <h2>Changer votre mot de passe:</h2>
        <form action="" method="post">
            <label for="actualPassword">Votre mot de passe actuel :</label>
            <input pattern="[A-Za-z0-9]+" placeholder="********" name="actualPassword" type="password"><br>
            
            <label for="newPassword">Votre nouveau mot de passe :</label>
            <input pattern="[A-Za-z0-9]+" placeholder="********" name="newPassword" type="password"><br>

            <label for="newPasswordConfirmed">Confirmer votre nouveau mot de passe :</label>
            <input pattern="[A-Za-z0-9]+" placeholder="********" name="newPasswordConfirmed" type="password"><br>

            <button type="submit">Envoyer</button>
        </form>
    </section>
    <br>
    <a href="dashboard.php">Retour</a>
</body>
</html>