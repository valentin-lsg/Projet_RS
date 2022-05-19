<?php 
session_start();
include("fonctionsPHP.php");
checkLogin();

$userInfos = fromTableUsers();
changerInfoPerso($userInfos);
changePassword();
gererMonCompte();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier les informations personnelles</title>
    <link rel="stylesheet" href="../Page HTML/editInfosPerso.css">
</head>
<body>

    <img class="displayed" src="../Page HTML/image/testhibou3.png" alt="">
    <div id="page">
        
        <text id="informations">Mes informations</text>
            <text id="lastName">Votre nom de famille : <?= $userInfos["lastname"]; ?></text>
            <text id="firstName">Votre prénom : <?= $userInfos["name"] ?></text>
            <text id="mail">Votre Mail : <?= $userInfos["mail"] ?></text>
            <text id="country">Pays : <?= $userInfos["country"] ?></text>
            <text id="birthDate">Date de naissance : <?= $userInfos["birthday"] ?></text>
            <text id="phoneNumber">Numéro de telephone : <?= $userInfos["phone"] ?></text>
            <text  id="username">Nom d'utilisateur : <?= $userInfos["username"] ?></text>

            
            
            <form action="" method="post"> <!-- ICI YA UN FORMULAIRE -->
                <button id="desactiverAccount" name="desactiverCompte" type="submit" >Désactiver votre compte</button>
                <button name="supprimerCompte" type="submit" id="suppAccount">Supprimer définitivement votre compte</button>
            </form>


            <text id="changeInfos">Changer vos informations</text>
                <form action="" method="post"> <!-- ICI YA UN FORMULAIRE -->
                    <label id="newUsername" for="username">Nom d'utilisateur :</label>
                    <input maxlength="30" name="username" type="text">
                    <br>
                    <label id="newLastName" for="lastname">Nom de famille :</label>
                    <input name="lastname" type="text">
                    <br>
                    <label id="newFirstName" for="name">Prénom :</label>
                    <input name="name" type="text">
                    <br>
                    <label id="newMail" for="mail">Adresse mail :</label>
                    <input name="mail" type="email">
                    <br>
                    <label id="newCountry" for="country">Pays :</label>
                    <select name="country">
                        <?php include("select.php") ?>
                    </select>
                    <br>
                    <label id="newBirthDate" for="date">Date de naissance :</label>
                    <input name="birthday" min="1950-01-01" max="2020-12-31" type="date">
                    <br>
                    <label id="newNumber"
                    for="phone">Numéro de téléphone :</label>
                    <input name="phone" type="number">
                    <br>


                <text id="changeMdp">Changer votre mot de passe</text>
                <br>
                <label  id="actualMdp" for="actualPassword">Votre mot de passe actuel :</label>
                <input pattern="[A-Za-z0-9]+" placeholder="********" name="actualPassword" type="password">
                <br>
                <label id="newMdp" for="newPassword">Votre nouveau mot de passe :</label>
                <input pattern="[A-Za-z0-9]+" placeholder="********" name="newPassword" type="password">
                <br>
                <label id="confirmNewMdp" for="newPasswordConfirmed">Confirmer votre nouveau mot de passe :</label>
                <input pattern="[A-Za-z0-9]+" placeholder="********" name="newPasswordConfirmed" type="password">
                <br>
                <button type="submit">Enregistrer les changements</button>
            </form>
        
        
        <a href="profil.php">Retour</a>
    </div>
</body>
</html>