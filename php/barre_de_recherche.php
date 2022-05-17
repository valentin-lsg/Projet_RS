<?php
/* $bdd = new PDO('mysql:host=localhost;dbname=no;','root', 'root');
$allusers = $bdd->query('SELECT * FROM users ORDER BY id DESC');
if (isset($_GET['s']) AND !empty($_GET['s'])){
    $recherche = htmlspecialchars($_GET['s']);
    $allusers = $bdd->query('SELECT * FROM users WHERE username=:username');
    $alluser = execute([
        ":username" => $username
    ])

} */


$test = filter_input(INPUT_POST, "envoyer");

function rechercherUser(){
    if(isset($test)){
        require("../pdo/pdo.php");
        $username = "admin";
    
        $maRequete = $pdo->prepare("SELECT * FROM users WHERE username=:username");
        $maRequete->execute([
        ":username" => $username
        ]);
        $result = $maRequete->fetch();
        if($result->rowCount() > 0){
            echo  '<p>$user['.$valueInResult["username"].'</p>';
        }else{
            echo "<p>Pas d'utilisateur</p>";
        }
    }
}


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <title>barre de recherche</title>
    <meta charset="UTF-8">
</head>
<body>
    <form method ="POST">
        <input type="search" name="s" placeholder="recherche un utilisateur" autocomplete = "off">
        <button type="submit" name="envoyer">Envoyer</button>
        
    </form>
    <section class = "afficher_utilisateur">
        <?php
rechercherUser()

        ?>
         
    </section>
</body>
</html>