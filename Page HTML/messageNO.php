<?php

session_start();

$engine = "mysql";
$host = "localhost";
$port = 3306;
$dbname = "no";
$username = "root";
$password = "root";


$pdo = new PDO("$engine:host=$host:$port;dbname=$dbname", $username ,$password);


if(empty($_GET)){
    $body = file_get_contents('php://input');

<<<<<<< HEAD
// Pour récuper grâce au JSON

function getMessages(){

    // variable déclaré ici sinon c'est comme si elle n'existe pas
    global $db;

    // Sortir les 20 derniers messages
    $resultats = $db->query("SELECT * FROM messages ORDER BY created_at DESC LIMIT 20");
    $messages = $resultats->fetchAll();

    // $msg[$send] = str_replace(':)', '<img src="emojis/emoji_smile.png" />', $msg[$send]); // pour mettre les smiley

    // Affichage des données format JSON
    echo json_encode($messages);
}

// Analyse de l'envoie en POST pour les mettre dans la base de données

function postMessage(){

    // variable déclaré ici sinon c'est comme si elle n'existe pas
    global $db;

    // Analyse des paramètres en POST
    if(!array_key_exists("who_send", $_POST) || !array_key_exists("send", $_POST)){
        echo json_encode(["status" => "erreur", "message" => "Aucun contenu envoyé"]);
    }
=======
    $body = json_decode($body, true);
    $un = $body['one'];
    $deux= $body['two'];
    $trois = $body['three'];
    $create = date('Y-m-d H:i:s');
>>>>>>> fec52a81c5117a3cff963743b9e2f045b1540b6a
    

<<<<<<< HEAD
    // $msg[$send] = str_replace(':)', '<img src="emojis/emoji_smile.png" />', $msg[$send]); // pour mettre les smiley

    // Requête pour insérer les données
    $query = $db->prepare("INSERT INTO messages SET who_send = :who_send, who_receive = :who_receive, send = :send, created_at = NOW()");
    $query->execute([
        "who_send" => $who_send,
        "send" => $send,
        "who_receive" => $who_receive
    ]);

    // $msg[$send] = str_replace(':)', '<img src="emojis/emoji_smile.png" />', $msg[$send]); // pour mettre les smiley

    echo json_encode(["status" => "succès"]);
=======
    $envoie = $pdo->prepare("INSERT INTO messages (`created_at`,send,who_send,who_receive) VALUES('$create','$trois', ? ,?)");
    $envoie  -> execute([$deux , $un]);
>>>>>>> fec52a81c5117a3cff963743b9e2f045b1540b6a
}

else if(!(empty($_GET))){

    $us = $_SESSION['id'];
    $recep = $_GET['id'];

    $recep = $pdo-> prepare ("SELECT send,who_send,who_receive FROM messages WHERE who_send = :a AND who_receive = $recep OR who_send = $recep AND who_receive = :d ");
    $recep -> execute([':a' => $us,':d' => $us]);
    $statm = $recep ->fetchAll(PDO::FETCH_ASSOC);
    foreach($statm as $stat):?>

        <div class= "num"><?=$stat['who_send']; ?></div>
        <div class ="msg"><?=$stat['send'];?></div>

        

       <?php endforeach;
}?>


