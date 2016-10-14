<?php
session_start();
require_once("Database.class.php");
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
  <section class="container-fluid">
    <div class="row">
      <h1 class="col-lg-12 text-center">LISTE : </h1>
<?php
  if(isset($_SESSION['login'])) {
    echo ('
    <form class="col-lg-12" method="post">
      <label class="col-lg-4">Quelle liste voulez vous afficher ?</label>
      <select class="col-lg-4" name="choixAAfficher">
            <option value="personnages" selected>Personnages</option>
            <option value="villes">Villes</option>
            <option value="evenements">Evènements</option>
        </select>
        <button type="submit" name="listeAAfficher">Affiche</button>
    </form>
    ');

    if(isset($_POST['listeAAfficher'])) {
    $ceQueJeDoisAfficher =  $_POST['choixAAfficher'];
    $Tozor = new Database;
    $Tozor->listAll($ceQueJeDoisAfficher);
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
