<?php
  session_start();

  session_destroy();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta lang="fr">
    <title>Déconnexion</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
</head>


<body>
  <section class="container-fluid navigation">
    <?php
      include('header.php');
    ?>
  </section>
  <section class="container text-center">
    <div class="row login-component">
      <h1 class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Déconnexion</h1>
      <p class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Vous avez bien été déconnecté-e.</p>
    </div>
  </section>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="JS/jdrscript.js"></script>
    </div>
</body>
</html>
