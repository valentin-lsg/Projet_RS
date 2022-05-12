<?php 


// Envoi les données de l'utilisateur dans la base de donnée
function envoyerDansBaseDeDonnée($register, $lastname, $name, $country, $birthday, $phone, $username1, $password, $mail){
    if(isset($register)) {
        require("../pdo/pdo.php");
        $cryptedpassword = password_hash($password, PASSWORD_DEFAULT);
        try {
            $marequete = $pdo->prepare("INSERT INTO users (lastname, name, mail, country, password, birthday, phone, account_state, username) VALUES (:lastname, :name, :mail, :country, :password, :birthday, :phone, :account_state, :username);");
            $marequete->execute([
                ":lastname" => $lastname,
                ":name" => $name,
                ":mail" => $mail,
                ":country" => $country,
                ":password" => $cryptedpassword,
                ":birthday" => $birthday,
                ":phone" => $phone,
                ":account_state" => 0,
                ":username"  => $username1             
            ]);
            header('Location: login.php');
            /* echo '<script>','alert("Vous avez été correctement inscrit en tant que '.$username1.' ")'.'</script>'; */
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
    $marequete = $pdo->prepare("SELECT * FROM users where username = :username"); 
    $marequete->execute([
        ":username" => $username1
    ]);
    $row = $marequete->fetch(PDO::FETCH_ASSOC); 
       

    if(password_verify($candidate_password, $row["password"])){
        $_SESSION["username"]=$username1;
        $_SESSION["id"]=$row["id"];
        http_response_code(302);
        header("location: dashboard.php");
        exit();
    } else {
        echo '<script>','alert("Le mot de passe est faux.")'.'</script>';

    }
};
