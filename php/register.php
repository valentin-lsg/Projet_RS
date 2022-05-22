<?php


$register = filter_input(INPUT_POST, "register");  /* Le button pour envoyer la demande d'inscription */
$lastname = filter_input(INPUT_POST,"lastname"); 
$name = filter_input(INPUT_POST,"name");
$country = filter_input(INPUT_POST,"country");
$birthday = filter_input(INPUT_POST,"birthday");
$phone = filter_input(INPUT_POST,"phone", FILTER_SANITIZE_NUMBER_INT); 
$username1 = filter_input(INPUT_POST, "username");
$password = filter_input(INPUT_POST, "password");
$mail = filter_input(INPUT_POST, "mail", FILTER_VALIDATE_EMAIL);


// Envoi les données de l'utilisateur dans la base de donnée
include("fonctionsPHP.php");

// Verifier la date pour qu'elle ne soit pas bizarre

if(isset($register)){
    if(verifDate($birthday)){
        if($lastname != NULL && $name != NULL && $country != NULL && $birthday != NULL && $phone != NULL && $username1 != NULL && $password != NULL && $mail != NULL){
            envoyerDansBaseDeDonnée($register, $lastname, $name, $country, $birthday, $phone, $username1, $password, $mail);
        }else{
            echo '<script>','alert("Saisie incorrecte ! Il faut remplir tout les champs.")'.'</script>';
        }
    }
    
}



?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" sizes="16x16" href="../Page HTML/image/logoNO.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../Page HTML/ConnexionInscriptionNO.css">
    <title>Night~of~Owls</title>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <img src="../Page HTML/image/logoNO.png" class="logo" alt="logo">
            </div>
            <div class="col">
                <div class="formulaire">
                    <h1>Bienvenue sur Night~of~Owls Social Club</h1>

                    <form method="post" class="row g-3 needs-validation" novalidate>
                        <div class="col-md-4">
                            <label for="validationCustom02" class="form-label">Nom</label>
                            <input type="text" name="lastname" class="form-control" id="validationCustom02" placeholder="l'Hermite" required>
                            <div class="valid-feedback">
                                ça à l'air bon !
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom01" class="form-label">Prénom</label>
                            <input type="text" name="name" class="form-control" id="validationCustom01" placeholder="Bernard" required>
                            <div class="valid-feedback">
                                ça à l'air bon !
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom03" class="form-label">Adresse Mail</label>
                            <input type="email" name="mail" class="form-control" id="validationCustom03" required>
                            <div class="invalid-feedback">
                                Veuillez entrer votre adresse mail
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom05" class="form-label">Mot de Passe</label>
                            <input type="password" name ="password" pattern="[A-Za-z0-9]+" class="form-control" id="validationCustom05" placeholder="********" required>
                            <div class="invalid-feedback">
                                Choisir un mot de passe valide
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom06" class="form-label">Date de naissance</label>
                            <input type="date" min="1950-01-01" max="2020-12-31" name="birthday" class="form-control" id="validationCustom01"  required>
                            <div class="valid-feedback">
                                ça à l'air bon !
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom06" class="form-label">Numéro de téléphone</label>
                            <input type="tel" name="phone" class="form-control" id="validationCustom01" placeholder="0601020304" required>
                            <div class="valid-feedback">
                                ça à l'air bon !
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustomUsername" class="form-label">Nom d'utilisateur</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                <input type="text" name="username" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                                <div class="invalid-feedback">
                                    Veuillez choisir un nom d'utilisateur
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="validationCustom04" class="form-label">Localisation</label>
                            <select name="country" class="form-select" id="validationCustom04" required>
                                <?php include("select.php") ?>
                            </select>
                            <div class="invalid-feedback">
                                Veuillez choisir un lieu valide
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                                <label class="form-check-label" for="invalidCheck">
                                Accepter les conditions d'utilisation
                                </label>
                                <div class="invalid-feedback">
                                    Vous devez agréer aux conditions d'utilisation
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                        <button class="btn btn-primary" name="register" type="submit">Envoyer</button>   
                        </div>
                    <a href="index.php">Se connecter en cliquant ici</a>
                    </form>
                    

                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>