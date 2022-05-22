
<?php

session_start();



$engine = "mysql";
$host = "localhost";
$port = 3306;
$dbname = "no";
$username = "root";
$password = "root";


$pdo = new PDO("$engine:host=$host:$port;dbname=$dbname", $username ,$password);
$user = $pdo->prepare("SELECT name,id FROM users"); 
$user->execute();
$log = $user->fetchAll(PDO::FETCH_ASSOC);



?>



<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" send="IE=edge" />
    <meta name="viewport" send="width=device-width, initial-scale=1.0" />
    <link
      rel="icon"
      type="image/x-icon"
      sizes="16x16"
      href="./image/logoNO.ico"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" type="text/css" href="MenuNO.css" />
    <title>Night of Owls</title>
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Night of Owls Navigation</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedsend"
          aria-controls="navbarSupportedsend"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedsend">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#"
                >Fil d'actualité</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Divers</a>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="navbarDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Profil
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Modifier</a></li>
                <li><a class="dropdown-item" href="#">Informations</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li>
                  <a class="dropdown-item" href=""
                    >Se déconnecter</a
                  >
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled">Messages</a>
            </li>
          </ul>
          <form class="d-flex">
            <input
              class="form-control me-2"
              type="search"
              placeholder="Recherche"
              aria-label="Search"
            />
            <button class="btn btn-outline-success" type="submit">Go</button>
          </form>
        </div>
      </div>
    </nav>

    <section class="chat">
      <div class="messages">
        <br />
      </div>
      <div class="userInput">
        <form class="form" method="POST">
          <select name="" id="">
            <?php
              foreach($log as $loog):
            ?>
            <option value="<?=$loog['id'] ?>"><?=$loog['name']?></option>

            <?php endforeach;?>
          </select>
          <input placeholder="Taper un message" type="text" />

          <button type="submit">Envoyé</button>
        </form>
        <form action="../php/profil.php">
        <button type="submit">Retour</button>
        </form>
      </div>
      
      
    </section>

    <!--     <script src="messageNO.js"></script> -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
    <script>
      let $form = document.querySelectorAll("form");
      let $input = document.querySelectorAll("input");
      let div_messages = document.querySelector(".messages")
      let ooption;
      let the_name;
      let flexou
      let toto= div_messages.querySelectorAll('*')
      let select = document.querySelectorAll('select *')
      for(let i = 0; i < select.length; i++){

      
      select[i].addEventListener('click', function(){
        console.log(select[i].value)
        ooption = select[i].value;
        the_name = select[i].textContent;



      })
    }


      $form[1].addEventListener("submit", function (event) {
        event.preventDefault();
        $input.value = '';
        div_messages.innerHTML = '';
        let text_un = $input[1].value.trim();

        let data = {
          one: ooption,
          two: <?= $_SESSION['id']; ?>,
          three: text_un,
        };

        fetch("messageNO.php", {
          method: "POST",
          body: JSON.stringify(data),
        });


        fetch('messageNO.php?id='+ooption)
      .then((resp) => resp.text())
      .then((resp)=>{

        let div = document.createElement("div");
        div.classList.add('flex')
        div_messages.appendChild(div)

        div.innerHTML = resp;

        flexou = document.querySelectorAll('.flex *');
        let num = document.querySelectorAll('.num');
        let msg = document.querySelectorAll('.msg');

        for(let i = 0; i < flexou.length; i++){

          if(flexou[i].textContent === '<?= $_SESSION['id']; ?>'){
            console.log(flexou[i])
            flexou[i].classList.add('end')
            flexou[i+1].classList.add('end')
            flexou[i].textContent = '<?= $_SESSION['username']; ?>' + ' :'

        }
        else if(flexou[i].textContent === ooption) {
          flexou[i].classList.add('start')
            flexou[i+1].classList.add('start')
            flexou[i].textContent = the_name + ' :'
        }

      }

       }) 

      });
      function reset (){
        fetch('messageNO.php?id='+ooption)
      .then((resp) => resp.text())
      .then((resp)=>{

        let div = document.createElement("div");
        div.classList.add('flex')
        div_messages.appendChild(div)

        div.innerHTML = resp;

        let flexou = document.querySelectorAll('.flex *');
        let num = document.querySelectorAll('.num');
        let msg = document.querySelectorAll('.msg');

        for(let i = 0; i < flexou.length; i++){

          if(flexou[i].textContent === '<?= $_SESSION['id']; ?>'){
            console.log(flexou[i])
            flexou[i].classList.add('end')
            flexou[i+1].classList.add('end')
            flexou[i].textContent = '<?= $_SESSION['username']; ?>' + ' :'

        }
        else if(flexou[i].textContent === ooption) {
          flexou[i].classList.add('start')
            flexou[i+1].classList.add('start')
            flexou[i].textContent = the_name + ' :'
        }

      }

       })
      }


    </script>
  </body>
</html>
