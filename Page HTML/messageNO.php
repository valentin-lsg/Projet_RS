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

    $body = json_decode($body, true);
    $un = $body['one'];
    $deux= $body['two'];
    $trois = $body['three'];
    $create = date('Y-m-d H:i:s');
    

    $envoie = $pdo->prepare("INSERT INTO messages (`created_at`,send,who_send,who_receive) VALUES('$create','$trois', ? ,?)");
    $envoie  -> execute([$deux , $un]);
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


