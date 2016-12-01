<?php
  session_start();
  require_once("Database.class.php");
 ?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="">
    <title>A propos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta lang="fr">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
</head>

<body>
  <section class="container-fluid">
    <?php
      include('header.php');
    ?>
  </section>
    <section class="container-fluid">
        <div class="row generate-component">
            <section class="col-lg-12 text-center">
                <h1>JDRFormu</h1>
                <h2>Générez avec facilité</h2>
            </section>
            <section class="col-lg-12 text-center">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <h4>Créez du contenu fictionnel</h4>
                    <p class="text-left">Générez des personnages, des villes et des évènements de manière simple et rapide puis, si vous êtes membre, enregistrez les. </p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <h4>Exploitez le</h4>
                    <p class="text-left">Accédez au contenu créé par les autres membres afin de vous donner des idées de personnages, de villes et d'évènements. </p>
                </div>
            </section>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="JS/jdrscript.js"></script>

  </body>
  </html>
