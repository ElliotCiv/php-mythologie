<?php
// session_start() nous permet d'utiliser $_SESSION sur cette page
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
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
    <?php
    include "pdo.php";
    include "requete.php";

    if (!empty($_SESSION['user'])) {
        header('location: index.php');
    }
    ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                
                <form action="" method="POST" class="mb-5">
                    <div class="mb-3">
                        <label for="pseudo" class="form-label">Pseudo</label>
                        <input type="text" class="form-control" id="pseudo" name="pseudo" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-outline-dark" name="btn_connexion">Se connecter</button>
                </form>
            </div>
        </div>
        <a href="inscription.php" class="main-a">Pas encore inscrit ?</a>
    </div>
    <div class="container">
        <?php 
            
            if (isset($_GET['existe'])) {
                if($_GET['existe'] === "0") {
                    echo "<p>Inscription effectuée</p>";
                } else {
                    echo "<p>Echec inscription</p>";
                }
            }
        ?>
    </div>


    <?php
    
    if (isset($_POST['btn_connexion'])) {

        $user = requete_findUser($_POST['pseudo']);

        if (!$user) {

            echo "<p>Pseudo inexistant !</p>";

        } else if ($_POST['pseudo'] === $user['pseudo_user'] && password_verify($_POST['password'],$user['password_user'])) {

            $_SESSION['user'] = $_POST['pseudo'];
            $_SESSION['id'] = $user['id_user'];

            header('location: index.php');

        } else {
            echo "<p>Mot de passe ou identifiant incorrect !</p>";
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