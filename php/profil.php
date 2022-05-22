<?php 
session_start();

include("fonctionsPHP.php");

checkLogin();
/* Création d'une publication */
$boutonEnvoiMonPost = filter_input(INPUT_POST, "boutonEnvoiMonPost");
$titrePublication = filter_input(INPUT_POST, "titrePublication");
$textePublication = filter_input(INPUT_POST, "textePublication");

if(isset($boutonEnvoiMonPost)){
    $monCheminImage = uploadMaPhoto("imagePublication", "post");
    if($monCheminImage != "Erreur, votre photo n'a pas été upload."){
        if($titrePublication && $textePublication){
            creerUnePublication($monCheminImage, $textePublication, $titrePublication); 
        }
        
    };
    
};


if(isset($_GET['research']) AND !empty($_GET['research'])){
    $bdd = new PDO('mysql:host=localhost; dbname=no;','root','root');
    $allmembers = $bdd->prepare('SELECT * FROM users ORDER BY id DESC');
    $search = htmlspecialchars($_GET['research']);
    $allmembers = $bdd->query('SELECT * FROM users WHERE username LIKE "' .$search.'%" ORDER BY id DESC');
}

if(isset($_POST['Ajouter'])){
    require('../pdo/pdo.php');
    $idFriend  = filter_input(INPUT_POST,"idFriend");    
    
    // REQUETE 1 : Recuperer le username de l'ami grâce à $idFriend

    $userfriend = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    $userfriend->execute([
        ":id" => $idFriend 
    ]);
    $result = $userfriend->fetch();
    // REQUETE 2 : Verifier si l'ami n'est pas déjà dans la friendlist de l'utilisateur

     $verification = $pdo->prepare('SELECT * FROM friendlist WHERE friend_id = :friend_id AND user_id = :user_id');
     $verification->execute([
         ":friend_id" => $idFriend,
         ":user_id" => $_SESSION["id"] 
     ]);
     $resultat = $verification->rowCount();
     
    // Si $resultat == 0 alors l'ami n'est pas dans la friendlist de l'utilisateur
    if($resultat == 0){

      // REQUETE 3 : Ajout dans la friendlist 
      $ajouteAmi = $pdo->prepare('INSERT INTO friendlist (friend_id,friend_username,user_id) VALUES (:friend_id, :friend_username, :user_id)');
      $ajouteAmi->execute([
          ":friend_id" => $idFriend,
          ":friend_username" => $result["username"],
          ":user_id" => $_SESSION["id"]
      ]); 
    }
    
    

     
    
}


?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de profil <?= $_SESSION["username"] ?></title>
    <link rel="stylesheet" href="../Page HTML/profil.css" />

</head>


<body>
    <div id="page">
      <div id="Top">

       <?php afficherMaBanniere("") ?>

        <div class="banner_container">
          <?php afficherMonImageDeProfil(""); ?>

          <div class="fleex">
            <div id="name"><?php 
            afficherMonUsername("");
            ?></div>
            <div id="biography">
            <?php 
            afficherMaBiographie("");
            ?>
            </div>
          </div>
        </div>
      </div>
    
      
    <div class="coteAcote">
      <div class="margin">
        <div id="publication_container">
        <form action="" method="post" enctype="multipart/form-data">
          <div id="publication"> 
          <h2>Créer une publication :</h2>

            <input id="text" placeholder="Titre" type="text" name="titrePublication">

            <input type="text" placeholder="Contenu..."id="text" name="textePublication">
            
            <div id="button">
             
              <input  class="button button1" name="imagePublication" type="file">
              
            </div>
            <button name="boutonEnvoiMonPost" type="submit" class="button button2">Envoyer</button>
          </div>
        </form>
        </div>
      </div>
      <div class="margin">
        <div id="publication_container">
        <form action="" method="post" enctype="multipart/form-data">
          <div id="publication"> 
          <h2>Créer une page :</h2>

            <input id="text" placeholder="Titre" type="text" name="titrePublication">

            <input type="text" placeholder="Contenu..."id="text" name="textePublication">
            
            <div id="button">
              <input class="button button1" name="imagePublication" type="file">
              
            </div>
            <button name="boutonEnvoiMonPost" type="submit" class="button button2">Envoyer</button>
          </div>
        </form>
        </div>
      </div>
    </div>

      <div class="flex">
        <div id="personnalInformations">
            <br>
            <h3>Gérer votre compte :</h3>
            <a href="../Page HTML/MenuNO.php">Envoyer un message</a><br>
            <a href="profilSetting.php">Editer mon profil</a><br>
            <a href="personnalSetting.php">Editer vos infos persos</a><br>  
            <a href="deconnexion.php">Se deconnecter</a>
            <br>
            <form method="GET">
            <input type="search" name="research" placeholder="Rechercher un membre">
            <input type="submit" value="recherche">
            </form>
            <br>
            <?php
            if(isset($allmembers)){
              rechercherAmi($allmembers);
          };

            
            function rechercherAmi($allmembers){
              
                if($allmembers->rowCount() > 0){
                foreach($allmembers as $valueInAllMembers){
                    if($valueInAllMembers["id"] != $_SESSION["id"]){
                      require('../pdo/pdo.php');
                      $maRequete = $pdo->prepare("SELECT * FROM friendlist where user_id=:user_id and friend_id =:friend_id");
                      $maRequete->execute([
                      ":user_id" => $_SESSION["id"],
                      ":friend_id" => $valueInAllMembers["id"]
                      ]);
                      $reponse = $maRequete->rowCount();
                      
                      if($reponse > 0){
                        echo '<a href="friendDashboard.php?id='.$valueInAllMembers['id'].'">'.$valueInAllMembers['username'].'</a>'.
                        '<form method="POST" action="profil.php">'.
                        '<input type="hidden" name="idFriend" value="'. $valueInAllMembers['id'] . '" />'.
                        '</form>';
                      }else{
                        echo '<a href="friendDashboard.php?id='.$valueInAllMembers['id'].'">'.$valueInAllMembers['username'].'</a>'.
                        '<form method="POST" action="profil.php">'.
                        '<input type="hidden" name="idFriend" value="'. $valueInAllMembers['id'] . '" />'.
                        '<input type="submit" name="Ajouter" value="Ajouter">'.
                        '</form>';
                      }
                        
                    }
                    
                }  
            }
            };

            
            // Afficher la liste d'ami de l'utilisateur
            $maListeAmi = afficherMaListeAmi();
            echo "<table><tr><th>Votre liste d'ami :</th></tr>";
            if(isset($maListeAmi)){
              foreach($maListeAmi as $valueInMaListeAmi){
                echo '<tr><td><form method="GET"action="deleteFriend.php?id='.$valueInMaListeAmi['friend_id'].
                '"><button name="friend_id" type="submit" value="'.$valueInMaListeAmi['friend_id'].'">X</button> '.
                '<a href="friendDashboard.php?id='.$valueInMaListeAmi['friend_id'].'">'.$valueInMaListeAmi['friend_username'].
                '</a></form>'.'</td></tr>';
              }
            };      
            echo "</table>";
            
            
    ?>
        </div>
        
            <div class="content_all">
            <?php afficherMesPublications("") ; ?>            
                
        </div>
      </div>


    </div>

   
  </body>
</html>


    

    

 