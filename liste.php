<?php
session_start();
require_once("Database.class.php");
if( ! (isset($_SESSION['login']) ) ) {
  header('Location: error401.php');
} else {
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="">
    <title>Liste</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta lang="fr">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
</head>

<body>
  <section class="container-fluid navigation">
    <?php
      include('header.php');
    ?>
  </section>
  <section class="container">
    <div class="row generate-component">
      <h1 class="col-lg-12 text-center">Liste</h1>
<?php
  if(isset($_SESSION['login'])) {
    ?>
    <form class="col-lg-12 col-md-12 col-sm-12 col-xs-12 generate-form" method="post">
      <label class="col-lg-4 col-md-4 col-sm-4 col-xs-12">Quel type d'éléments voulez vous afficher ?</label>
      <select class="col-lg-3 col-md-3 col-sm-3 col-xs-12 offset-lg-1 offset-md-1 offset-sm-1" name="choixAAfficher">
            <option value="personnages" selected>Personnages</option>
            <option value="villes">Villes</option>
            <option value="evenements">Evènements</option>
        </select>
        <button class="col-lg-4 col-md-4 col-sm-4 col-xs-12 btn btn-lg" type="submit" name="listeAAfficher">Lister</button>
    </form>
    <?php

    if(isset($_POST['listeAAfficher'])) {
    $ceQueJeDoisAfficher =  $_POST['choixAAfficher'];
    ?>
      <p class="text-center">Voici la liste des <?php echo "$ceQueJeDoisAfficher" ?> : </p>
    <?php
    $Tozor = new Database;
    $Tozor->listAll($ceQueJeDoisAfficher);
    }
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
