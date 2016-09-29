<?php
  session_start();
  require_once('Database.class.php');
 ?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="">
    <title>l0g1nat0r</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta lang="fr">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
</head>

<body>
    <section class="container-fluid">
        <div class="row">
        <?php
            if(isset($_POST['loginForm'])) {

                // 2 variables qui récupèrent ce qui a été saisi
                $userLogin = htmlspecialchars($_POST['login']);
                $userPass = htmlspecialchars($_POST['pass']);

                $Anju = new Database;
                $Anju->loginCheck($userLogin);

                $userPassRef = $_POST['refPass'];

                if(password_verify($userPass, $userPassRef)) {
                  // 2 variables de session sont créées et récupèrent ce qui a été saisi dans le champ
                  $_SESSION['login'] = $userLogin;
                  $_SESSION['password'] = $userPass;

                    echo '<p class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center"> ' . $_SESSION['login'] . ' est connecté(e)</p>';
                } else {
                  echo "<p class='col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center'> Votre login ou votre mot de passe n'est pas valide !</p>";
                }
            }

            if(isset($_SESSION['login'])) {
              echo '<a class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center" href="logout.php"> déconnexion </a>';
            }
        ?>
            <a class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center" href="index.php">vers la page d'accueil</a>
            <h1 class="col-lg-12 text-center">Connectez-vous</h1>
            <form class="col-lg-12" action="" method="post">
                <label class="col-lg-4">UserName</label>
                <input class="col-lg-6" type="text" placeholder="login" name="login">
                <label class="col-lg-4">PSWD</label>
                <input class="col-lg-6" type="text" placeholder="password" name="pass">
                <button class="col-lg-2" type="submit" name="loginForm">Se connecter</button>
            </form>
        </div>
    </section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="JS/jdrscript.js"></script>

</body>
</html>
