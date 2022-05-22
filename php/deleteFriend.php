<?php 
session_start();
include('fonctionsPHP.php');

$friend_id = filter_input(INPUT_GET, "friend_id", FILTER_VALIDATE_INT);
if($friend_id){
    supprimerUnAmi($friend_id);
    http_response_code(302);
    header('Location: profil.php');
    exit();
};

?>