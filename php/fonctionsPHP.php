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
            echo '<script>','alert("Vous avez été correctement inscrit en tant que '.$username1.' ")'.'</script>';
            } catch (\PDOException $e) {
                if ($e->errorInfo[1] == 1062) {
                    echo '<script>','alert("Erreur, votre requête a été annulée.")','</script>';
                
                }
            
        }
    }

};
