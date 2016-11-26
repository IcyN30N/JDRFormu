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
  <section class=" navigation container-fluid">
    <?php
    include('header.php');
    ?>
  </section>
  <section class="container">
    <div class="row login-component">
      <h1 class="col-lg-12 text-center">Connexion</h1>
      <form class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left login-form" action="" method="post">
          <label class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Login</label>
          <input class="col-lg-12 col-md-12 col-sm-12 col-xs-12" type="text" placeholder="login" name="login">
          <label class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Mot de passe</label>
          <input class="col-lg-12 col-md-12 col-sm-12 col-xs-12" type="text" placeholder="password" name="pass">
          <div class="col-lg-4"></div>
          <button class="col-lg-4 btn btn-lg" type="submit" name="loginForm">Se connecter</button>
          <div class="col-lg-4"></div>
      </form>

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
            } else {
              ?>
              <p class='col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'> Votre login / mot de passe est invalide !</p>
              <?php
            }
          }
        ?>
    </div>
  </section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="JS/jdrscript.js"></script>

</body>
</html>
