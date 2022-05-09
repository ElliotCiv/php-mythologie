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
    include "pdo.php";
    include "requete.php";
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


      <main role="main" class="inner cover">
          <div class="container-fluid ">
              <div class="row">
                <?php

                    $article=requete_lire_all_article();

                    foreach ($article as $value){

                        if(isset($_POST['btn_'.$value['id_article']])){

                          header("location: article.php?titre=".$value['titre_article']);
                          
                        };
                        $user= requete_findUserId($value['id_user']);

                        echo '<div class="col col-3">
                            <h3>'.$value['titre_article'].'</h3>
                            <p>'.substr($value['contenu_article'],0,50).'...</p>
                            <img src="img/'.$value['image_article'].'" class="rounded mx-auto d-block" alt="">
                            <form action="" method="POST">
                            <button type="submit" class="btn btn-outline-dark align-self-end art" name="btn_'.$value['id_article'].'">Lire plus</button>
                            </form>
                            <h5>Ecrit le '.$value['date_article'].' par '.$user['pseudo_user'].' </h5>
                            </div>';
                        
                    }
                    if(isset($_POST['btn_ajoutArt'])){

                      header('location:creaArticle.php');

                    }
                    if(isset($_SESSION['user'])){

                      $user=requete_findUser($_SESSION['user']);

                      if($user['id_role']===1){

                        echo '<form method="post" action=""><button class="btn btn-outline-dark" name="btn_ajoutArt" >Ajouter un article</button></form>';
                        
                      }
                    }
                    
                         
                    ?>
              </div>
              <br>
          </div>
      </main> 
      
      <footer>
      <div class="inner">
        <nav class="nav justify-content-center">
            <p id="pFooter">© Mythologie Grecque. Tous droits réservés.</p>
        </nav>
      </div>
      </footer>
      
</body>
</html>