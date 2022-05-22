<?php 
session_start();
include("fonctionsPHP.php");

$idDuPost = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if($idDuPost){
    supprimerPublication($idDuPost);
    http_response_code(302);
    header("location: profil.php");
    exit();
}


?>