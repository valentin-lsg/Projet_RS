<?php
session_start();


include("fonctionsPHP.php");

// Ne se lance que si on est en post
// id : riri , mdp = test
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = filter_input(INPUT_POST, "login"); 
    $username1 = filter_input(INPUT_POST, "username");
    $candidate_password = filter_input(INPUT_POST, "password");
    // Fonction qui permet de se connecter
    seConnecter($login, $username1, $candidate_password);
    
    // Afficher un message confirmant l'inscription.

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

                    <form action="" method="POST" class="row g-3 needs-validation" novalidate>
                        <div class="col-md-4">
                            <label for="validationCustom03" class="form-label">Nom d'utilisateur</label>
                            <input name="username" type="text" class="form-control" id="validationCustom03" placeholder="test123" required>
                            <div class="invalid-feedback">
                                Veuillez entrer votre nom d'utilisateur
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom05" class="form-label">Mot de Passe</label>
                            <input name="password" type="password" class="form-control" id="validationCustom05" placeholder="********" required>
                            <div class="invalid-feedback">
                                Choisir un mot de passe valide
                            </div>
                        </div>
                        <div class="col-12">
                            
                            <button class="btn btn-primary" type="submit" name="login">Se connecter</button>

                        </div>
                        <a href="register.php">S'inscrire en cliquant ici</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
