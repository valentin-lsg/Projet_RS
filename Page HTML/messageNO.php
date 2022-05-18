<?php

// Connexion à la base de donnée avec un PDO

$db = new PDO("mysql:host=localhost;dbname=no;charset=utf8", "root", "root", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

// Aiguillage grâce à l'URL pour savoir si on reçois ou si on envoie un message

$task = "list";

if(array_key_exists("task", $_GET)){
    $task = $_GET["task"];
}

if($task == "write"){
    postMessage();
}
else{
    getMessages();
}

// Pour récuper grâce au JSON

function getMessages(){

    // variable déclaré ici sinon c'est comme si elle n'existe pas
    global $db;

    // Sortir les 20 derniers messages
    $resultats = $db->query("SELECT * FROM messages ORDER BY created_at DESC LIMIT 20");
    $messages = $resultats->fetchAll();

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
    
    $who_send = $_POST["who_send"];
    $send = $_POST["send"];
    $who_receive = $_POST["who_receive"];

    // Requête pour insérer les données
    $query = $db->prepare("INSERT INTO messages SET who_send = :who_send, who_receive = :who_receive, send = :send, created_at = NOW()");
    $query->execute([
        "who_send" => $who_send,
        "send" => $send,
        "who_receive" => $who_receive
    ]);
    echo json_encode(["status" => "succès"]);
}

?>