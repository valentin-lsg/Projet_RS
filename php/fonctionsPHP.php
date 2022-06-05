<?php 

// Créer un fichier sur le serveur qui contiendra ce que l'utilisateur upload (photo profil, banniere).
// * $path : Représente le repertoire cible
function makeDir($path)
{
     return is_dir($path) || mkdir($path);
}

// Verification de la cohérence de la date
// * $birthday : Représente la date de naissance de l'utilisateur lors de son inscription
function verifDate($birthday){
    $verifDateLimit = explode("-", $birthday);
    echo $verifDateLimit[0];
    if($verifDateLimit[0] >= 2020){
        return false;
    }else{
        return true;
    }

}

// Envoi les données de l'utilisateur dans la base de donnée
// * $register : Variable qui me permet de savoir si le bouton 'register' a été enclenché par l'utilisateur
// * $lastname, $name, [...], $mail : Information que l'utilisateur entre lors de son inscription
function envoyerDansBaseDeDonnée($register, $lastname, $name, $country, $birthday, $phone, $username1, $password, $mail){
    if(isset($register)) {
        require("../pdo/pdo.php");
        $cryptedpassword = password_hash($password, PASSWORD_DEFAULT);
        
        try {

            // REQUETE 1 : Inscription
            $maRequete = $pdo->prepare("INSERT INTO users (lastname, name, mail, country, password, birthday, phone, account_state, username) VALUES (:lastname, :name, :mail, :country, :password, :birthday, :phone, :account_state, :username);");
            $maRequete->execute([
                ":lastname" => $lastname,
                ":name" => $name,
                ":mail" => $mail,
                ":country" => $country,
                ":password" => $cryptedpassword,
                ":birthday" => $birthday,
                ":phone" => $phone,
                ":account_state" => 0,
                ":username"  => $username1,
                        
            ]); 

            // REQUETE 2 : Récupération de l'id du nouvel inscrit
            $maRequete = $pdo->prepare("SELECT id from users where username=:username");
            $maRequete->execute([
            ":username" => $username1 
            ]);
            $idDeMonUser = $maRequete->fetch();

            // REQUETE 3 : Création d'un profil temporaire.
            $maRequete = $pdo->prepare("INSERT INTO profil (banner, profil_picture, description, user_id) VALUES (:banner, :profil_picture, :description, :user_id);");
            $maRequete->execute([
            ":banner" => "../upload/default/default_banner.png", 
            ":profil_picture" => "../upload/default/default_pp.png", 
            ":description" => "Ceci est la description de"." ".$username1, 
            ":user_id" => $idDeMonUser["id"]
            ]);

            // Dernière étape : Lui créer un répertoire sur le serveur.

            $newPath = "../upload/profil/".$username1;
            makeDir($newPath);
            $newPath = "../upload/profil/".$username1."/banner";
            makeDir($newPath);
            $newPath = "../upload/profil/".$username1."/profilPicture";
            makeDir($newPath);
                   

            /* echo '<script>','alert("Vous avez été correctement inscrit en tant que '.$username1.' ")'.'</script>'; */
            http_response_code(302);
            header("location: index.php");
            exit();
            
            } catch (\PDOException $e) {
                if ($e->errorInfo[1] == 1062) {
                    echo '<script>','alert("Erreur, votre requête a été annulée.")','</script>';
                    
                }
            
        }
       
    }

};

// Fonction de connexion
// * $login : Variable qui me permet de savoir si le bouton 'login' a été enclenché par l'utilisateur
// * $username1 : Le nom de compte
// * $candidate_password : Le mot de passe associé au compte
function seConnecter($login, $username1, $candidate_password){
    if(!$login){ // 
        if($username1==NULL or $candidate_password==NULL){
            echo '<script>','alert("Erreur ! Veuillez remplir les champs.")','</script>';
            return;
        }
    };
    
    require("../pdo/pdo.php");
    $maRequete = $pdo->prepare("SELECT * FROM users where username = :username"); 
    $maRequete->execute([
        ":username" => $username1
    ]);
    $row = $maRequete->fetch(PDO::FETCH_ASSOC); 
       

    if(password_verify($candidate_password, $row["password"])){
        $_SESSION["username"]=$username1;
        $_SESSION["id"]=$row["id"];
        http_response_code("302");
        header('Location: profil.php');
        exit();
    } else {
        echo '<script>','alert("Vos informations de connexion sont incorrectes.")'.'</script>';

    }
};

// Fonction qui verifie si l'utilisateur est bien connecté lorsqu'il navigue entre les pages.
// Vérifie également si le compte est autorisé à se connecter via la fonction 'checkAccountState()'
function checkLogin(){
    if(!isset($_SESSION["username"])) { 
        http_response_code(302);
        header('Location: index.php');
        exit();
    }
    checkAccountState();
};


// Verifie si le compte est autorisé à se connecter
// * $monUser : Les données de mon utilisateur que je récupère depuis la base de donnée.
// * $userAccountState : Donne un chiffre entre 0 et 1. Le premier signifiant que le compte est
//                       autorisé à se connecter tandis que le second indique que le compte n'y est pas autorisé.
function checkAccountState(){
    $monUser = fromTableUsers();
    $userAccountState= $monUser["account_state"];
    if($userAccountState == 1){
        http_response_code(302);
        header("location: reactivateAccount.php");
        exit();
    } 
};

// Fonction qui permet de désactiver, réactiver ou supprimer son compte par requête SQL.
// * $desactiverCompte : Variable qui me permet de savoir si le bouton 'desactiverCompte' a été enclenché par l'utilisateur
// * $reactiverCompte : Variable qui me permet de savoir si le bouton 'reactiverCompte' a été enclenché par l'utilisateur
// * $supprimerCompte : Variable qui me permet de savoir si le bouton 'supprimerCompte' a été enclenché par l'utilisateur
function gererMonCompte(){
    $desactiverCompte = filter_input(INPUT_POST, "desactiverCompte");
    $reactiverCompte = filter_input(INPUT_POST, "reactiverCompte");
    $supprimerCompte = filter_input(INPUT_POST, "supprimerCompte");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($desactiverCompte)){
            require("../pdo/pdo.php");
            $id = $_SESSION["id"];
            $maRequete = $pdo->prepare("UPDATE users SET account_state=:account_state WHERE id=:id");
            $maRequete->execute([
            ":account_state" => 1,
            ":id" => $id
            ]);
            http_response_code(302);
            header("location: deconnexion.php");
            exit();

        } else if(isset($reactiverCompte)){
            require("../pdo/pdo.php");
            $id = $_SESSION["id"];
            $maRequete = $pdo->prepare("UPDATE users SET account_state=:account_state WHERE id=:id");
            $maRequete->execute([
            ":account_state" => 0,
            ":id" => $id
            ]);
            http_response_code(302);
            header("location: deconnexion.php");
            exit();

        } else if(isset($supprimerCompte)){
            require("../pdo/pdo.php");
            $id = $_SESSION["id"];
            $maRequete = $pdo->prepare("DELETE from users where id=:id");
            $maRequete->execute([
            ":id" => $id
            ]);
            http_response_code(302);
            header("location: index.php");
            exit();
        } 
    }
};




// Fonction qui permet à l'utilisateur d'upload une image sur le serveur.
// * $nameOfTheInput : Nom de la balise 'input' qui permet l'upload.
// * $destination : Variable qui me permet de diriger le fichier vers le repertoire 'profil' ou le repertoire 'post'
//                  si l'utilisateur upload une image pour son profil (photo de profil) ou bien une image pour
//                  accompagner un post. 
// * $error : Petite variable qui est égal à 0 si l'upload a été un succès, sinon elle est égal à 1.
// * $myFilePath : Le répertoire final sur le serveur ou sera stockée l'image.
// Petit information complémentaire : Si $destination == "post" alors cette fonction nous renvoie $myFilePath
// qui est le chemin vers l'image.
function uploadMaPhoto($nameOfTheInput, $destination){
    $error = 0;
    if(isset($_FILES[$nameOfTheInput]) && $_FILES[$nameOfTheInput]['error'] == 0){
        if($_FILES[$nameOfTheInput]['size'] <= 10000000){
            $imageInfos = pathinfo($_FILES[$nameOfTheInput]['name']);
            $extensionImage = $imageInfos['extension'];
            $extensionAutorisee = array('png', 'jpeg', 'jpg');

            if(in_array($extensionImage, $extensionAutorisee)){
                $fileName = time().rand().'.'.$extensionImage;

                if($destination == "profil"){
                    $sessionUsername = $_SESSION["username"];
                    $myFilePath = "../upload/profil/".$sessionUsername."/"."profilPicture/".$fileName;
                } else if($destination == "post"){
                    $myFilePath = "../upload/post/".$fileName;
                }
                
                move_uploaded_file($_FILES[$nameOfTheInput]['tmp_name'], $myFilePath);

            }else {
                $error = 1;
            }

        } else {
            $error = 1;
        }
    }else{
        return;
    }

    if($error == 1){
        echo "Erreur, votre photo n'a pas été upload.";
        return "Erreur, votre photo n'a pas été upload.";
    } else if($error == 0 && $destination == "profil") {
        require("../pdo/pdo.php");
        $id = $_SESSION["id"];
        $profil_picture = $myFilePath;
        $maRequete = $pdo->prepare("UPDATE profil SET profil_picture=:profil_picture WHERE user_id=:id");
        $maRequete->execute([
        ":profil_picture" => $profil_picture,
        ":id" => $id
        ]);
        /* http_response_code(302);
        header("location: dashboard.php");
        exit(); */
    } else if($error == 0 && $destination == "post") {
        return $myFilePath;

    };
};

// Fonction similaire à la fonction 'uploadMaPhoto($nameOfTheInput, $destination)' 
function uploadMaBanniere(){
    $error = 0;
    if(isset($_FILES['banner']) && $_FILES['banner']['error'] == 0){

        if($_FILES['banner']['size'] <= 10000000){
            $imageInfos = pathinfo($_FILES['banner']['name']);
            $extensionImage = $imageInfos['extension'];
            $extensionAutorisee = array('png', 'jpeg', 'jpg', 'gif');

            if(in_array($extensionImage, $extensionAutorisee)){
                $sessionUsername = $_SESSION["username"];
                $fileName = time().rand().'.'.$extensionImage;
                $myFilePath = "../upload/profil/".$sessionUsername."/"."banner/".$fileName;
                move_uploaded_file($_FILES['banner']['tmp_name'], $myFilePath);
                
            }else {
                $error = 1;
            }

        } else {
            $error = 1;
        }
    }else{
        $error = 2;
    }

    if($error == 1){
        echo "Erreur, votre banniere n'a pas été upload.";
    } else if($error == 0) {
        require("../pdo/pdo.php");
        $id = $_SESSION["id"];
        $banner = $myFilePath;
        $maRequete = $pdo->prepare("UPDATE profil SET banner=:banner WHERE user_id=:id");
        $maRequete->execute([
        ":banner" => $banner,
        ":id" => $id
        ]);
        /* http_response_code(302);
        header("location: dashboard.php");
        exit(); */
    } else {
        return;
    }

};

// Fonction qui permet à l'utilisateur de changer sa description
// * $laNouvelleDescription : La nouvelle description que l'utilisateur souhaite affecter à son profil
function changeDescriptionUser($laNouvelleDescription){
    require("../pdo/pdo.php");
    $id = $_SESSION["id"];
    $description = $laNouvelleDescription;
    $maRequete = $pdo->prepare("UPDATE profil SET description=:description WHERE user_id=:id");
    $maRequete->execute([
    ":description" => $description,
    ":id" => $id
    ]);
};

// Fonction qui permet de récupérer toutes les informations sur le profil d'un utilisateur grâce à son id.
// * $id : L'id de l'utilisateur dont on veux récupérer les données.
//         Si l'id n'est pas spécifié (c'est à dire $id = ""), alors il prendra la valeur de l'id de la session en cours.
// * $result : Variable qui contient les informations qui ont été récupérées depuis la base de donnée.
function fromTableProfil($id){
    require("../pdo/pdo.php");
    if(!$id){
       $id = $_SESSION["id"]; 
    }
    $maRequete = $pdo->prepare("SELECT * from profil where id=:id");
    $maRequete->execute([
    ":id" => $id
    ]);
    $result = $maRequete->fetch();
    return $result;
};

// Créer une balise qui affiche l'image de profil de l'utilisateur en fonction de l'id
function afficherMonImageDeProfil($id){
    $result = fromTableProfil($id);
    $imageDeMonUser = $result["profil_picture"];
    echo "<div id='picture'><img style='width : 100%; height : 100% ; object-fit : cover;' src='$imageDeMonUser' alt='Image de profil'></div>";
};

// Créer une balise qui affiche la bannière de profil de l'utilisateur en fonction de l'id
function afficherMaBanniere($id){
    $result = fromTableProfil($id);
    $banniereDeMonUser = $result["banner"];
    echo "<div id='banner'><img style='width : 100%; height : 100% ; object-fit : cover;' src='$banniereDeMonUser' alt='Banniere de profil'></div>";
    
};

// Créer une balise qui affiche la description du profil de l'utilisateur en fonction de l'id
function afficherMaBiographie($id){
    $result = fromTableProfil($id);
    $bioDeMonUser = $result["description"];
    echo "<h3>$bioDeMonUser</h3>";
};

// Affiche le nom de l'utilisateur en fonction de l'id
function afficherMonUsername($username){
    if(!$username){
        echo $_SESSION["username"];
    }
    echo $username;
    
};


// Fonction qui permet de récupérer toutes les informations de l'utilisateur en fonction de son id.
// * $id : L'id de l'utilisateur dont on veux récupérer les données.
// * $result : Variable qui contient les informations qui ont été récupérées depuis la base de donnée.
function fromTableUsers(){
    require("../pdo/pdo.php");
    $id = $_SESSION["id"];
    $maRequete = $pdo->prepare("SELECT * from users where id=:id");
    $maRequete->execute([
    ":id" => $id
    ]);
    $result = $maRequete->fetch();
    return $result;
};

// Fonction qui permet à l'utilisateur de changer ses informations personnelles.
// * $userInfos : Variable qui contient les données de l'utilisateur issue de la table 'users'
//                Elle me sert à ne permettre à mon utilisateur de changer son pays si et seulement
//                si le nouveau pays est différent du pays qui est stocké dans la table 'users'.
function changerInfoPerso($userInfos){
    if($_SERVER["REQUEST_METHOD"] == "POST"){
       
        $lastname = filter_input(INPUT_POST,"lastname"); 
        $name = filter_input(INPUT_POST,"name");
        $country = filter_input(INPUT_POST,"country");
        $birthday = filter_input(INPUT_POST,"birthday");
        $phone = filter_input(INPUT_POST,"phone", FILTER_SANITIZE_NUMBER_INT); 
        $username1 = filter_input(INPUT_POST, "username");
        $mail = filter_input(INPUT_POST, "mail", FILTER_VALIDATE_EMAIL);

        require("../pdo/pdo.php");
        $id = $_SESSION["id"];
        $changementEffectue = 0;


        if($lastname){
            $maRequete = $pdo->prepare("UPDATE users SET lastname=:lastname WHERE id=:id");
            $maRequete->execute([
                ":id" => $id,
                ":lastname" => $lastname
                ]);
            $changementEffectue++;
        };
        if($name){
            $maRequete = $pdo->prepare("UPDATE users SET name=:name WHERE id=:id");
            $maRequete->execute([
                ":id" => $id,
                ":name" => $name
                ]);
        };
        if($country && ($country != $userInfos["country"])){
            $maRequete = $pdo->prepare("UPDATE users SET country=:country WHERE id=:id");
            $maRequete->execute([
                ":id" => $id,
                ":country" => $country
                ]);
            $changementEffectue++; 
            
        };
        if($birthday){
            if(verifDate($birthday)){
                $maRequete = $pdo->prepare("UPDATE users SET birthday=:birthday WHERE id=:id");
                $maRequete->execute([
                    ":id" => $id,
                    ":birthday" => $birthday
                    ]);
                $changementEffectue++;
            };
            

        };
        if($phone){
            $verificationPhone = strlen((string)$phone);
            if($verificationPhone == 10){
                $maRequete = $pdo->prepare("UPDATE users SET phone=:phone WHERE id=:id");
                $maRequete->execute([
                    ":id" => $id,
                    ":phone" => $phone
                    ]);
                $changementEffectue++;  
            };

        };
        if($username1){
            $maRequete = $pdo->prepare("UPDATE users SET username=:username WHERE id=:id");
            $maRequete->execute([
                ":id" => $id,
                ":username" => $username1
                ]);
            $changementEffectue++;

        };
        
        if($mail){
            $maRequete = $pdo->prepare("UPDATE users SET mail=:mail WHERE id=:id");
            $maRequete->execute([
                ":id" => $id,
                ":mail" => $mail
                ]);
            $changementEffectue++;

        };

        if($changementEffectue > 0){
            http_response_code(302);
            header("location: personnalSetting.php");
            exit();
        };
        

    }
};

// Fonction qui permet à l'utilisateur de changer son mot de passe 
// * $actualPassword : Le mot de passe actuel de l'utilisateur
// * $newPassword : Le nouveau mot de passe 
// * $newPasswordConfirmed : Un confirmation du nouveau mot de passe
// * $donneeDeMonUser : Variable qui contient les données de l'utilisateur issue de la table 'users' de la base de donnée
// * $hashPassword : Crypte la variable $newPassword avant de la stocker dans la base de donnée.
function changePassword(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $actualPassword = filter_input(INPUT_POST, "actualPassword");
        $newPassword = filter_input(INPUT_POST, 'newPassword');
        $newPasswordConfirmed = filter_input(INPUT_POST, 'newPasswordConfirmed');
        
        
        if($actualPassword && $newPassword && $newPasswordConfirmed){
            if($newPassword == $newPasswordConfirmed){
                $donneeDeMonUser = fromTableUsers();

                if(password_verify($actualPassword, $donneeDeMonUser["password"])){
                    require("../pdo/pdo.php");
                    $id = $_SESSION["id"];
                    $hashPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                    $maRequete = $pdo->prepare("UPDATE users SET password=:password WHERE id=:id");
                    $maRequete->execute([
                        ":id" => $id,
                        ":password" => $hashPassword
                        ]);
                    echo "<center>Le mot de passe a été changé.</center>";

                } else {
                    /* echo "<script> alert('Le mot de passe actuel ne correspond pas !') </script>"; */
                    echo "<center>Le mot de passe actuel ne correspond pas.</center>";
                }

            }else{
                /* echo "<script> alert('Les deux mots de passe ne correspondent pas. !') </script>"; */
                echo "<center>Le nouveau mot de passe ne correspond pas au mot de passe de confirmation.</center>";
            }
            
        } else if($actualPassword or $newPassword or $newPasswordConfirmed){
            /* echo "<script> alert('Un des champs est vide !') </script>"; */
            echo "<center>Un des champs est vide.</center>";
        }
    } 
    
};

// Fonction qui permet de créer une publication qui apparaitra sur le profil de l'utilisateur.
// Une publication comporte : Un titre, un Texte et eventuellement une Image.
// * $monCheminImage : Cette variable représente le chemin vers l'image. 
//                     Pour obtenir le chemin vers l'image, j'utilise la fonction 'uploadMaPhoto($nameOfTheInput, $destination)'
//                     avec $destination == "post".
// * $textePublication : Le nouveau mot de passe 
// * $titrePublication : Un confirmation du nouveau mot de passe
function creerUnePublication($monCheminImage, $textePublication, $titrePublication){
    require("../pdo/pdo.php");
    $id = $_SESSION["id"];
    $image = $monCheminImage;
    $text = $textePublication;
    $commentary = "";
    $title = $titrePublication;
    

    $maRequete = $pdo->prepare("INSERT INTO post (user_id, title, text, image, commentary) VALUES (:user_id, :title, :text, :image, :commentary)");
    $maRequete->execute([
    ":text" => $text,
    ":user_id" => $id,
    ":title" => $title,
    ":image" => $image,
    ":commentary" => $commentary
    ]);
        
}

// Fonction qui permet de récupérer toutes les informations sur les posts d'un utilisateur grâce à son id.
// * $id : L'id de l'utilisateur dont on veux récupérer les données.
//         Si l'id n'est pas spécifié (c'est à dire $id = ""), alors il prendra la valeur de l'id de la session en cours.
// * $result : Variable qui contient les informations qui ont été récupérées depuis la base de donnée.
function fromTablePost($id){
    require("../pdo/pdo.php");
    if(!$id){
       $id = $_SESSION["id"]; 
    }
    
    $maRequete = $pdo->prepare("SELECT * FROM post where user_id=:user_id ORDER BY id DESC");
    $maRequete->execute([
    ":user_id" => $id
    ]);
    $result = $maRequete->fetchall(PDO::FETCH_ASSOC);
    return $result;
}


// Fonction qui permet d'afficher tous les posts d'un utilisateur en fonction de son id.
// * $id : L'id de l'utilisateur dont on veux afficher les posts.
//         Si l'id n'est pas spécifié (c'est à dire $id = ""), alors il prendra la valeur de l'id de la session en cours. 
//         (voir fonction 'fromTablePost($id)')
// Petite information complémentaire : Les balises des posts existent en deux versions avec une fonctionnalité qui leur est unique. 
//                                       Une version propriétaire qui permet de supprimer la publication. 
//                                       Et une seconde version publique qui permet de commenter la publication.
function afficherMesPublications($id){
    if(!$id){
        $mesPosts = fromTablePost("");
    }else{
        $mesPosts = fromTablePost($id);
    }
    
    foreach($mesPosts as $valueMesPosts){
        
        $monImage = '<img id="post1" src="'.$valueMesPosts["image"].'"  alt="image">';
        $maBaliseExiste = ($valueMesPosts["image"] != NULL) ? $monImage : "";

        if(!$id){
            echo  '<div id="content"><h2>'.$valueMesPosts["title"].'</h2>'
            .$maBaliseExiste.
            '<div id="post2">'.$valueMesPosts["text"].'
            </div>'.'<a href="voirCommentaire.php?id='.$valueMesPosts["id"].'">
            Voir les commentaires
        </a>
    <a href="deletePoste.php?id='.$valueMesPosts["id"].'">
                Supprimer
            </a>'.'</div>';
        }else{
            echo '<div id="content"><h2>'.$valueMesPosts["title"].'</h2>'.
            $maBaliseExiste.'
                <div id="post2">'.$valueMesPosts["text"].'</div>
                <form method="post">
                <input name="commentaire" type="text">
                <input type="hidden" name="idDeCePost" value="'.$valueMesPosts["id"].'">
                <button type="submit" name="sendCommentaire">Envoyer</button></form>
                <br>
                <a href="voirCommentaire.php?id='.$valueMesPosts["id"].'">
                        Voir les commentaires
                    </a>'.'</div>';
        }
        

        
         
    }
    
};



// Fonction qui permet à un visiteur de commenter la publication
// * $idVisiteur : Le mot de passe actuel de l'utilisateur
// * $sendCommentaire : Variable qui permet de savoir si le bouton 'sendCommentaire' a été enclenché par l'utilisateur
function commenterUnePublication($idVisiteur){
    $sendCommentaire = filter_input(INPUT_POST, "sendCommentaire");

    if(isset($sendCommentaire)){
        $text = filter_input(INPUT_POST, "commentaire");
        $idDuPost = filter_input(INPUT_POST, "idDeCePost");
        if($text != NULL){
            require("../pdo/pdo.php");
            $maRequete = $pdo->prepare("INSERT INTO commentary (post_id, user_id, text) VALUES (:post_id, :user_id, :text)");
            $maRequete->execute([
            "post_id" => $idDuPost,
            "user_id" => $idVisiteur,
            ":text" => $text
            ]);
        }
        
    }
    
    
    

};


// Fonction qui permet de supprimer une publication
// * $idDuPost : Représente l'id du post dans la table 'post' de la base de donnée
function supprimerPublication($idDuPost){  
    require("../pdo/pdo.php");
    $maRequete = $pdo->prepare("DELETE FROM post where id = :publicationId");
    $maRequete->execute([
    ":publicationId" => $idDuPost
    ]);

    
    
};

// Fonction qui récupère toutes les informations de la table 'friendlist' en fonction de l'id de l'utilisateur.
// * $result : Contient les informations issue de la table 'friendlist' de la base de donnée
function afficherMaListeAmi(){
    $id = $_SESSION["id"];
    require("../pdo/pdo.php");
    $maRequete = $pdo->prepare("SELECT * FROM friendlist where user_id=:user_id ORDER BY id ASC");
    $maRequete->execute([
    ":user_id" => $id
    ]);
    $result = $maRequete->fetchall(PDO::FETCH_ASSOC);
    return $result;


};

// Fonction qui permet de supprimer un utilisateur de sa liste d'ami en fonction de son id.
// * $friend_id : L'id de la personne que l'on souhaite supprimer de sa liste d'ami.
function supprimerUnAmi($friend_id){
    require("../pdo/pdo.php");
    $maRequete = $pdo->prepare("DELETE FROM friendlist where friend_id=:friend_id");
    $maRequete->execute([
    ":friend_id" => $friend_id
    ]);
};

