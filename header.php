<?php
  if(isset($_SESSION['login'])) {
?>
    <nav class="row text-center">
      <a class="col-lg-2 col-md-2 col-sm-2 col-xs-12" href="index.php">Accueil</a>
      <a class="col-lg-3 col-xs-12"href="autoGenerator.php">AutoGen</a>
      <a class="col-lg-3 col-xs-12" href="changeUserSettings.php">Modifier les paramètres utilisateurs</a>
      <a class="col-lg-3 col-xs-12" href="logout.php">Se déconnecter</a>
      <a class="col-lg-1 col-xs-12 text-right"><?php echo $_SESSION['login'] ?></a>
    </nav>
<?php
  } else {
?>
    <nav class="row text-center">
      <a class="col-lg-3 col-md-3 col-sm-3 col-xs-12" href="index.php">Accueil</a>
      <a class="col-lg-3 col-md-3 col-sm-3 col-xs-12" href="autoGenerator.php">AutoGen</a>
      <a class="col-lg-3 col-md-3 col-sm-3 col-xs-12" href="newAccount.php">S'inscrire</a>
      <a class="col-lg-3 col-md-3 col-sm-3 col-xs-12" href="login.php">Se connecter</a>
    </nav>
<?php
  }
?>
