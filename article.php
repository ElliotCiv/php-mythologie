<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Mythologie Grecque</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
      <?php
        session_start();
      ?>
      <header class="masthead mb-auto b-5">
        <div class="inner">
          <nav class="nav nav-masthead justify-content-center">
            <a class="nav-link" href="index.php">Accueil</a>

            <?php

              if (!isset($_SESSION['user'])){

                echo '<a class="nav-link" href="inscription.php">Inscription</a>
                      <a class="nav-link" href="connexion.php">Connexion</a>';

              }

              if (isset($_SESSION['user'])){

                echo '<a class="nav-link" href="deconnexion.php">Déconnexion</a>';

              }
            ?>  
          </nav>
        </div>
      </header>


      <main>
      <div class="container-fluid ">
              <div class="row">

                <?php
                    include "pdo.php";
                    include "requete.php";

                    $article=requete_findArticle($_GET['titre']);

                    $user= requete_findUserId($article['id_user']);
                    
                    echo '<div class="col">
                        <h3>'.$article['titre_article'].'</h3>
                        <p class="article">'.$article['contenu_article'].'</p>
                        <img src="img/'.$article['image_article'].'" class="rounded mx-auto d-block" alt="">
                        <h5>Ecrit le '.$article['date_article'].' par '.$user['pseudo_user'].' </h5>
                        </div>';

                  ?>
                  </div>
                  <br>
                  <?php
                    if(isset($_SESSION['user'])){

                        $user=requete_findUser($_SESSION['user']);

                        if($user['id_role']===1){

                            echo '<form action="#" method="post" onsubmit="return confirm("Really Delete?");"><button class="btn btn-outline-dark" type="submit" name="btn_suppr" onclick="confirmerSuppr()">Supprimer cet article</button></form>';
                        }
                    } 
                    
                    if (isset($_POST['btn_suppr'])) {
                      
                        $titre=$article['titre_article'];

                        requete_archiver_article($titre,$article['contenu_article'],$titre,$article['date_article'],$article['id_user']);

                        rename('img/'.$article['image_article'],'ancienneImg/'.$article['image_article']);

                        requete_supprimer_article($titre);

                        header('location:index.php');
                    } 
                    ?>
                  
          </div>
      </main>
      <footer>
      <div class="inner">
        <nav class="nav justify-content-center">
            <p id="pFooter">© Mythologie Grecque. Tous droits réservés.</p>
        </nav>
      </div>
      </footer> 
      <script src="script.js"></script>
</body>
</html>