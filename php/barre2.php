<?php
$bdd = new PDO('mysql:host=localhost; dbname=no;','root','root');
$allmembers = $bdd->prepare('SELECT * FROM users ORDER BY id DESC');
if(isset($_GET['research']) AND !empty($_GET['research'])){
    $search = htmlspecialchars($_GET['research']);
    $allmembers = $bdd->query('SELECT username FROM users WHERE username LIKE "' .$search.'%" ORDER BY id DESC');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rechercher des membres</title>
</head>
<body>
    <form method="GET">
        <input type="search" name="research" placeholder="Rechercher un membre">
        <input type="submit" value="recherche">
    </form>

    <section class="afficher_membres">
        <?php
            if($allmembers->rowCount() > 0){
                while($member = $allmembers->fetch()){
                    ?>
                    <p><?= $member['username'];?></p>
                    <?php
                }
            }
            ?>
    </section>

    
</body>
</html>