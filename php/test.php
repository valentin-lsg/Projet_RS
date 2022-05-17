<?php 
session_start();

include("fonctionsPHP.php");

checkLogin();

/* Création d'une publication */
$boutonEnvoiMonPost = filter_input(INPUT_POST, "boutonEnvoiMonPost");
$titrePublication = filter_input(INPUT_POST, "titrePublication");
$textePublication = filter_input(INPUT_POST, "textePublication");

if(isset($boutonEnvoiMonPost)){
    $monCheminImage = uploadMaPhoto("imagePublication", "post");
    if($monCheminImage != "Erreur, votre photo n'a pas été upload."){
        if($titrePublication && $textePublication){
            creerUnePublication($monCheminImage, $textePublication, $titrePublication); 
        }
        
    };
    
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
            .mesPost {
                display:flex;
                
            }
            body {
                width: 100%;
                background-color: #110D44;
                margin: 0;
                padding: 0;
                /* padding-top: 50px;
                padding-left: 200px;
                padding-right: 200px;
                padding-bottom: 50px; */
            }

            #page {
                width: 1150px;
                height: 1300px;
                background-color: white;
                margin: auto;
                display: flex;
                position: absolute;
                top: 100%; left: 50%;
                transform: translate(-50%, -50%);
                /* margin-left: 200px; */
                flex-flow: column wrap;
                border-radius: 13px;
                float: left;
            }

            #Top {
                width: 1150px;
                height: 430px;
                background-color: #E0E0E0;
                border-radius: 13px;
                float: left;
            }

            #banner {
                width: 1150px;
                height: 180px;
                background-color: #6F8695;
                position: absolute;
                border-top-left-radius: 13px;
                border-top-right-radius: 13px;
                float: left;
            }

            #picture {
                width: 10em;
                height: 10em;
                background-color: black;
                border-radius: 50%;
                position: absolute;
                margin-top: 120px;
                margin-left: 120px;
                float: left;
            }

            #name {
                position: relative;
                margin-left: 400px;
                margin-top: 190px;
                font-family: Tahoma, sans-serif;
                font-size: 30px;
                float: left;
            }

            #biography {
                font-family: Tahoma, sans-serif;
                margin-top: 10px;
                margin-left: 400px;
                padding-right: 20px;
                float: left;
            }

            #content {

                background-color: #6F8695;
                display: flex;



            }

            #post1 {

                background-color: #E1DAB7;

                display:flex;


            }

            /* #post2 {
                width: 700px;
                height: 350px;
                background-color: #E1DAB7;
                border-radius: 10px;
                display:flex;
                position: absolute;
                z-index: 2;
                margin-top: 450px;
                margin-left: 40px;
            } */

            #commentBar {

                border-radius: 25px;
                background-color: white;

            }

            #reaction {

                border-radius: 50%;

                background-color: #D8E8E9;

            }

            #reaction:hover {
                background-color: #A4C9CC;
                cursor: pointer;    
            }

            /* #reaction:focus {
                background-color: #7CB1B6;
            }

            #reaction:after {
                background-color: #A4C9CC;
            } */

            #personnalInformations {


                background-color: #B8B8B8;
                border-radius: 13px;

            }

            #groups {
                width: 70px;
                height: 70px;
                border-radius: 50%;
                background-color: #8F8F8F;
                margin-top: 10px;
                margin-left: 350px;
                float: left;
            }

            #groups:hover {
                background-color: #707070;
                cursor: pointer;
            }
        </style>
</head>
<body>
    <div id="page">
        <div id="Top">
            <img id="banner"></img>
            <img id="picture"></img>
            <div id="name">Username</div>
            <div id="biography">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</div>
        </div>
        <div>
        <div id="personnalInformations"></div>
        <div class="mesPost">
            <div id="content">
                <div id="post1"></div>
                <div id="post2"></div>
                <div id="post3"></div>
                <div id="commentBar"></div>
                <button id="reaction">
                </button>
            </div>
            
            
        </div>
        </div>
        
        <!-- <div id="groups"></div> -->
    </div>

    <script src="profil.js">
        // react = document.getElementById("reaction");
        // function changeColor() {
        //     react.addEventListener("click", function(e) {
        //         react.stylebackgroundColor = '#7CB1B6';
        //     })
        // }
              
    </script>
</body>
</html>