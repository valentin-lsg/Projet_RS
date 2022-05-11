<?php
session_start();

$login = filter_input(INPUT_POST, "login"); 
$username = filter_input(INPUT_POST, "username");
$candidate_password = filter_input(INPUT_POST, "password");


function seConnecter($login, $username, $candidate_password){
    require_once("pdo/pdo.php");
    if(isset($login)){ // 
        if($username=="" or $candidate_password==""){
            echo '<script>','alert("Erreur ! Veuillez remplir les champs.")','</script>';
        }
    };

    $marequete = $pdo->prepare("SELECT * FROM users where username = :username"); 
    $marequete->execute([
        ":username" => $username
    ]);
    $row = $marequete->fetch(PDO::FETCH_ASSOC); 

    if($row){ 
        
            if(password_verify($candidate_password, $row["password"])){
                $_SESSION["user"]=$username;
                $_SESSION["id"]=$row["id"];
                http_response_code(302);
                header("location: dashboard.php");
                exit();
            } else { // Erreur password
                echo '<script>','alert("Le mot de passe est faux.")','</script>'; 
            }
            } else if($username != $row["username"]) { // Erreur username
            echo '<script>','alert("Le nom d"utilisateur est faux.")','</script>';
    }


};

// Fonction qui permet de se connecter
seConnecter($login, $username, $candidate_password);






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NightOwl</title>

</head>
<body>

    <h2>Login</h2>
    <form method="post" action="">
        <label for="username">Identifiant :</label>
        <br>
        <input type="text" name="username" placeholder="Username">
        <br>
        <label for="password">Mot de passe :</label>
        <br>
        <input type="password" name="password" placeholder="********">
        <br>
        <button type="submit" name="login">Se connecter</button>
        
    </form>
    <a href="register.php"><button name="register">Inscription</button></a>


</body>
</html>
