<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=x, initial-scale=1.0">
    <title>Modifier les informations personnelles</title>
    <link rel="stylesheet" href="../Page HTML/editInfosPerso.css">
</head>
<body>
    <img class="displayed" src="../Page HTML/image/testhibou3.png" alt="">
    <div id="page">
        <text id="informations">Mes informations</text>
        <text id="username">Nom d'utilisateur : </text>
        <text id="lastName">Nom de famille : </text>
        <text id="firstName">Prénom : </text>
        <text id="mail">Adresse mail : </text>
        <text id="country">Pays : </text>
        <text id="birthDate">Date de naissance : </text>
        <text id="phoneNumber">Numéro de téléphone : </text>
        <button id="desactiverAccount">Désactiver votre compte</button>
        <button id="suppAccount">Supprimer définitivement votre compte</button>

        <text id="changeInfos">Changer vos informations</text>
        <text id="newUsername">Nom d'utilisateur : <input type="text" maxlength="30"></text>
        <text id="newLastName">Nom de famille : <input type="text"></text>
        <text id="newFirstName">Prénom : <input type="text"></text>
        <text id="newMail">Adresse mail : <input type="text"></text>
        <text id="newCountry">Pays : 
            
            <select name="pays">
                 <?php include('select.php') ?>
                </select>
        </text>
        <text id="newBirthDate">Date de naissance : <input type="date" id="start value="2018-07-22" min="1900-01-01" max="2022-05-20"></text>
        <text id="newNumber">Numéro de téléphone : <input type="text"></text>

        <text id="changeMdp">Changer votre mot de passe</text>
        <text id="actualMdp">Mot de passe actuel : <input type="text" placeholder="**********"></text>
        <text id="newMdp">Nouveau mot de passe : <input type="text" placeholder="**********"></text>
        <text id="confirmNewMdp">Confirmer nouveau mot de passe : <input type="text" placeholder="**********"></text>
    </div>
</body>
</html>