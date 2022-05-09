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


      <main>
        <form action="#" method="POST" enctype="multipart/form-data" id="formCreaArt">
          <label for="" class="labelCreaArt">Titre</label>
          <input type="text" name="titre" id="titreCreaArt" required><br><br>
          <label for="" class="labelCreaArt">Contenu</label>
          <input type="text" id="contenu" name="contenu" required> <br><br>
          <label for="" class="labelCreaArt">Image</label>
          <input type="file" name="image" id="image" required><br> <br>
          <button type="submit" name="confirmer" id="buttonCreaArt">Créer l'article</button>
        </form>
      </main>
      
      <?php

          if(isset($_POST['confirmer'])){

              $erreur=0;
              $type=0;

              $article=requete_findArticle($_POST['titre']);

              if($article){

                echo '<p>titre déjà existant!</p>';
                $erreur=1;

              }

              if(strlen($_POST['contenu'])<100){

                echo '<p>Contenu trop court, 100 caractères minimum!</p>';
                $erreur=1;

              }

              switch($_FILES['image']['type']){

                case("image/jpeg"):
                  $type=1;
                  break;

                case("image/png"):
                  $type=2;
                  break;

                default:
                  echo'mauvais type de fichier';
                  $erreur=1;
                  break;
              }

              if($erreur==0){

                  $date= date('d-m-y h:i:s');

                  $user=requete_findUser($_SESSION['user']);
                  $id=$user['id_user'];

                  $fichier=$_FILES["image"]["tmp_name"];

                  if ($type==1){

                    move_uploaded_file($fichier,"img/".$_POST['titre'].".jpg");

                    requete_ajout_article($_POST['titre'],$_POST['contenu'],$_POST['titre'].'.jpg',$date,$id);

                  }

                  if ($type==2){

                    move_uploaded_file($fichier,"img/".$_POST['titre'].".png");

                    requete_ajout_article($_POST['titre'],$_POST['contenu'],$_POST['titre'].'.png',$date,$id);

                  }

                  echo '<p>Article crée correctement!</p>';
              }
          } 
          
      ?>
      
      <footer>
      <div class="inner">
        <nav class="nav justify-content-center">
            <p id="pFooter">© Mythologie Grecque. Tous droits réservés.</p>
        </nav>
      </div>
      </footer>
      
</body>
</html>