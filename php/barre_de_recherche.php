<?php
$bdd = new PDO('mysql:host=localhost;dbname=no;','root', 'root');
$allusers = $bdd->query('SELECT * FROM users ORDER BY id DESC');
if (isset($_GET['s']) AND !empty($_GET['s'])){
    $recherche = htmlspecialchars($_GET['s']);
    $allusers = $bdd->query('SELECT username FROM users WHERE username LIKE "%'.$recherche.'%" ORDER BY id DESC');

}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <title>barre de recherche</title>
    <meta charset="UTF-8">
</head>
<body>
    <form method ="GET">
        <input type="search" name="s" placeholder="recherche un utilisateur" autocomplete = "off">
        <input type="submit" value = "envoyer">
    </form>
    <section class = "afficher_utilisateur">
        <?php
            if($allusers->rowCount() > 0){
                while($user = $allusers->fetch()){
                    ?>
                    <p><?= $user['username']; ?></p>
                    <?php
                }
            }else{
                ?>
                <p>pas d'utilisateur</p>
                <?php

            }

        ?>
         
    </section>
</body>
</html>