<?php 


// Envoi les données de l'utilisateur dans la base de donnée
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
            ":banner" => "../upload/default_banner.png", 
            ":profil_picture" => "../upload/default_pp.png", 
            ":description" => "Ceci est la description de"." ".$username1, 
            ":user_id" => $idDeMonUser["id"]
            ]);

                   

            /* echo '<script>','alert("Vous avez été correctement inscrit en tant que '.$username1.' ")'.'</script>'; */
            http_response_code(302);
            header("location: login.php");
            exit();
            
            } catch (\PDOException $e) {
                if ($e->errorInfo[1] == 1062) {
                    echo '<script>','alert("Erreur, votre requête a été annulée.")','</script>';
                    
                }
            
        }
       
    }

};

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
        http_response_code(302);
        header("location: dashboard.php");
        exit();
    } else {
        echo '<script>','alert("Vos informations de connexion sont incorrectes.")'.'</script>';

    }
};

function checkLogin(){
    if(!isset($_SESSION["username"])) { 
        http_response_code(302);
        header('Location: login.php');
        exit();
    } 
};

function uploadMaPhoto(){
    $error = 0;
    if(isset($_FILES['profilPicture']) && $_FILES['profilPicture']['error'] == 0){
        if($_FILES['profilPicture']['size'] <= 10000000){
            $imageInfos = pathinfo($_FILES['profilPicture']['name']);
            $extensionImage = $imageInfos['extension'];
            $extensionAutorisee = array('png', 'jpeg', 'jpg', 'gif');

            if(in_array($extensionImage, $extensionAutorisee)){
                $fileName = time().rand().'.'.$extensionImage;
                $myFilePath = "../upload/profil/".$fileName;
                move_uploaded_file($_FILES['profilPicture']['tmp_name'], $myFilePath);

            }else {
                $error = 1;
            }

        } else {
            $error = 1;
        }
    }else{
        $error = 1;
    }

    if($error == 1){
        echo "Erreur, votre photo n'a pas été upload.";
        $error = 0;
    } else {
        require("../pdo/pdo.php");
        $id = $_SESSION["id"];
        $profil_picture = $myFilePath;
        $maRequete = $pdo->prepare("UPDATE profil SET profil_picture=:profil_picture WHERE user_id=:id");
        $maRequete->execute([
        ":profil_picture" => $profil_picture,
        ":id" => $id
        ]);
        http_response_code(302);
        header("location: dashboard.php");
        exit();
    }
};

function uploadMaBanniere(){
    $error = 0;
    if(isset($_FILES['banner']) && $_FILES['banner']['error'] == 0){
        if($_FILES['banner']['size'] <= 10000000){
            $imageInfos = pathinfo($_FILES['banner']['name']);
            $extensionImage = $imageInfos['extension'];
            $extensionAutorisee = array('png', 'jpeg', 'jpg', 'gif');

            if(in_array($extensionImage, $extensionAutorisee)){
                $fileName = time().rand().'.'.$extensionImage;
                $myFilePath = "../upload/banner/".$fileName;
                move_uploaded_file($_FILES['banner']['tmp_name'], $myFilePath);
                
            }else {
                $error = 1;
            }

        } else {
            $error = 1;
        }
    }else{
        $error = 1;
    }

    if($error == 1){
        echo "Erreur, votre banniere n'a pas été upload.";
        $error = 0;
    } else {
        require("../pdo/pdo.php");
        $id = $_SESSION["id"];
        $banner = $myFilePath;
        $maRequete = $pdo->prepare("UPDATE profil SET banner=:banner WHERE user_id=:id");
        $maRequete->execute([
        ":banner" => $banner,
        ":id" => $id
        ]);
        http_response_code(302);
        header("location: dashboard.php");
        exit();
    }

};

function afficherMonImageDeProfil(){
    require("../pdo/pdo.php");
    $id = $_SESSION["id"];
    $maRequete = $pdo->prepare("SELECT * from profil where id=:id");
    $maRequete->execute([
    ":id" => $id
    ]);
    $result = $maRequete->fetch();
    $imageDeMonUser = $result["profil_picture"];
    echo "<img style='width: 10%;' src='$imageDeMonUser' alt='Image de profil'>".'<br>';
};

function afficherMaBanniere(){
    require("../pdo/pdo.php");
    $id = $_SESSION["id"];
    $maRequete = $pdo->prepare("SELECT * from profil where id=:id");
    $maRequete->execute([
    ":id" => $id
    ]);
    $result = $maRequete->fetch();
    $banniereDeMonUser = $result["banner"];
    
    echo "<img style='width: 10%;' src='$banniereDeMonUser' alt='Banniere de profil'>".'<br>';
};

function afficherMaBiographie(){
    require("../pdo/pdo.php");
    $id = $_SESSION["id"];
    $maRequete = $pdo->prepare("SELECT * from profil where id=:id");
    $maRequete->execute([
    ":id" => $id
    ]);
    $result = $maRequete->fetch();
    $bioDeMonUser = $result["description"];
    echo "<h3>$bioDeMonUser</h3>".'<br>';
};

function afficherMonUsername(){
    echo $_SESSION["username"];
};