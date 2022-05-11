<?php
require("pdo/pdo.php");

$register = filter_input(INPUT_POST, "register");  /* Le button pour envoyer la demande d'inscription */
$lastname = filter_input(INPUT_POST,"lastname" ); 
$name = filter_input(INPUT_POST,"name");
$country = filter_input(INPUT_POST,"country");
$birthday = filter_input(INPUT_POST,"birthday");
$phone = filter_input(INPUT_POST,"phone");





$username = filter_input(INPUT_POST, "user");
$password = filter_input(INPUT_POST, "password");
$mail = filter_input(INPUT_POST, "mail");


if(isset($register)) {
    if($user=="" or $password=="" or $mail==""){

        echo '<script>','alert("Erreur ! Il faut remplir tout les champs.")','</script>';

    } else  {

    $cryptedpassword = password_hash($password, PASSWORD_DEFAULT);
    try {
        $marequete = $pdo->prepare("INSERT INTO users (username, password, mail) VALUES (:user, :cryptedpassword, :mail);");
        $marequete->execute([
            ":user" => $user,
            ":cryptedpassword" => $cryptedpassword,
            ":mail" => $mail
        ]);
        
        echo '<center><h1 style="color:red">','Vous avez été correctement inscrit en tant que ', $user, '</h1></center>';

        } catch (\PDOException $e) { // Si jamais $marequête n'est pas executable, renvoie un message d'erreur. (username déjà présent dans BDD)
            if ($e->errorInfo[1] == 1062) {
                echo '<left><h2 style="color:red">','Cet identifiant est déjà pris !','</h2></left>';
            
            }
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="inscription.css">
</head>
<body>
    
    <div class="box">
        <div class="connexion">
        <h2>Inscription</h2>
        <form class="menu" method="POST">

            <div class="connexion1"><label for="user">Identifiant :</label>
            <div><input class='buttoncolor' placeholder="Mon id" type="text" name="user" id="user" /><br/></div></div>

            <div class="connexion2"><label for="password">Mot de passe :</label>
            <div><input class='buttoncolor' placeholder="********" type="password" name="password" id="password" /><br/></div></div>
            <div class="connexion3"><label for="mail">Email:</label>
            <div><input class='buttoncolor' placeholder="exemple@gmail.com" type="email" name="mail" id="mail" /><br/></div></div>
            <br>
            <div class="connexion2"><label for="password">Code secret:</label>
            <div><input class='buttoncolor' placeholder="********" type="password" name="secretcode" id="password" /><br/></div></div>
            <br>
            <div><input class="inscription" type="submit" value="Inscription" name="register"/></div>
            <br>
            <p class="pdulink"><a class="link_inscription" href="login.php">Retour à la page <strong>Login</strong></a></p>
            
            <input type="text" name="register">
            <input type="text" name="lastname">
            <input type="text" name="name">
            <input type="text" name="country">
            <input type="text" name="birthday">
            <input type="text" name="phone">
            <input type="text" name="account_state">
        </form>
        </div>
    </div>

</body>
</html>