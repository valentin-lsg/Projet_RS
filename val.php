<?php 
$register = filter_input(INPUT_POST, "register");  /* Le button pour envoyer la demande d'inscription */
$lastname = filter_input(INPUT_POST,"lastname" ); 
$name = filter_input(INPUT_POST,"name");


if($name && $lastname){
    echo "bonjour"." ".$name;
    echo "<br>"."comment vas tu?";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <label for="register">Inscription</label>
        <br>
        <input type="text" name="register">
        <br>

        <label for="register">Nom de famille</label>
        <br>
        <input type="text" name="lastname">
        <br>

        <label for="register">prénom</label>
        <br>
        <input type="text" name="name">
        <br>
        <button type="submit">Envoyer</button>
        

    </form>
</body>
</html>