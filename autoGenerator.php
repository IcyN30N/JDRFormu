<?php
  session_start();
  require_once("Database.class.php");
 ?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta lang="fr">
  <title>T.A.G (Truly Automatic Generat0r)</title>
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
      <h1 class="col-lg-12 text-center">Génération Auto</h1>
        <form class="col-lg-12 col-md-12 col-sm-12 col-xs-12 generate-form" action="autoGenerator.php" method="post">
            <label class="col-lg-4 col-md-4 col-sm-4 col-xs-12">Je veux générer :</label>
            <select name="genType" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 offset-lg-1 offset-md-1 offset-sm-1">
                <option value="personnage" selected>un personnage</option>
                <option value="ville">une ville</option>
                <option value="évènement">un évènement</option>
            </select>
            <button class="col-lg-4 col-md-4 col-sm-4 col-xs-12 btn btn-lg" type="submit">Générer</button>
        </form>

        <?php
        $Miawoo = new Database;
        if(isset($_POST['genType'])) {
          $selectVal = $_POST['genType'];
          switch ($selectVal) {
            case 'personnage':
              $randChar = $Miawoo->autoGenerate("personnage");

              // Stockage des valeurs randoms du personnage utilisées pour l'affichage
              $displayCharName = $randChar[0];
              $displayCharGender = $randChar[1][1];
              $displayCharClass = $randChar[2][1];
              $displayCharAge = $randChar[3];
              $displayCharElement = $randChar[4][1];
              $displayCharItems = "- ";

              // boucle afin de remplir la variable randCharObjets pour avoir une liste d'objets.
              if(!empty($randChar[5])) {
                $itemsArrayUsefulSize = count($randChar[5]);
                for($i = 0; $i < $itemsArrayUsefulSize; $i++) {
                  $itemToAdd = $randChar[5][$i];
                  $displayCharItems .= "" . $itemToAdd . " -";
                }
              }
              ?>
              <p class="text-center">Voici un personnage aléatoire:</p>
              <div class="row city-card text-center">
                <h2 class="col-lg-12"> <?php echo "$displayCharName" ?> </h2>
                <p class="col-lg-3 col-md-12 col-sm-12 col-xs-12 text-center"> <?php echo "$displayCharGender" ?> </p>
                <p class="col-lg-3 col-md-12 col-sm-12 col-xs-12 text-center"> <?php echo "$displayCharClass" ?> </p>
                <p class="col-lg-3 col-md-12 col-sm-12 col-xs-12 text-center"> <?php echo "$displayCharAge ans" ?> </p>
                <p class="col-lg-3 col-md-12 col-sm-12 col-xs-12 text-center"> <?php echo "$displayCharElement" ?> </p>
                <p class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center"> <?php echo "$displayCharItems" ?> </p>
              </div>
              <?php

              if(isset($_SESSION['login'])) {
                $_SESSION['userIsCreating'] = "personnage";
                // Stockage des valeurs randoms du personnage.
                $randCharName = $randChar[0];
                $randCharGender = $randChar[1][0];
                $randCharClass = $randChar[2][0];
                $randCharAge = $randChar[3];
                $randCharElement = $randChar[4][0];
                $randCharObjets = "";
                // boucle afin de remplir la variable randCharObjets pour avoir une liste d'objets.
                if(!empty($randChar[5])) {
                  $itemsArrayUsefulSize = count($randChar[5]) - 1;
                  for($i = 0; $i < $itemsArrayUsefulSize; $i++) {
                    $itemToAdd = $randChar[5][$i];
                    $randCharObjets .= "" . $itemToAdd . ",";
                  }
                  $randCharObjets .= "" . $randChar[5][$itemsArrayUsefulSize] . ".";
                }
                // stockage en session des données du personnage en cas de sauvegarde
                $_SESSION['persoNom'] = $randCharName;
                $_SESSION['persoGenre'] = $randCharGender;
                $_SESSION['persoClasse'] = $randCharClass;
                $_SESSION['persoAge'] = $randCharAge;
                $_SESSION['persoElement'] = $randCharElement;
                $_SESSION['persoObjets'] = $randCharObjets;
                ?>

                <form class="col-lg-12 col-md-12 col-sm-12 col-xs-12 generate-form" action="autoGenerator.php" method="post">
                  <label class="col-lg-4 col-md-4 col-sm-4 col-xs-12">sauvegarder ce personnage ? :</label>
                  <select name="saveToDB" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 offset-lg-1 offset-md-1 offset-sm-1">
                    <option value="oui" selected>oui</option>
                    <option value="non">non</option>
                  </select>
                  <button class="col-lg-4 col-md-4 col-sm-4 col-xs-12 btn btn-lg" type="submit">Valider</button>
                </form>

                <?php
                }
              break;

            case 'ville':
              $randCity = $Miawoo->autoGenerate("ville");
              // Stockage des valeurs randoms de la ville utilisées pour l'affichage
              $displayCityName = $randCity[0];
              $displayCitySize = $randCity[1][1];
              $displayCitySurroundings = $randCity[2][1];
              $displayCityLure = $randCity[3][1];
              ?>
              <p class="text-center">Voici une ville aléatoire:</p>
              <div class="row city-card text-center">
                <h2 class="col-lg-12"> <?php echo "$displayCityName" ?> </h2>
                <p class="col-lg-4 "> <?php echo "$displayCitySize" ?> </p>
                <p class="col-lg-4 "> <?php echo "$displayCitySurroundings" ?> </p>
                <p class="col-lg-4 "> <?php echo "$displayCityLure" ?> </p>
              </div>
              <?php
              if(isset($_SESSION['login'])) {
                $_SESSION['userIsCreating'] = "ville";

                // Stockage des valeurs randoms de la ville.
                $randCityName = $randCity[0];
                $randCitySize = $randCity[1][0];
                $randCitySurroundings = $randCity[2][0];
                $randCityLure = $randCity[3][0];

                // stockage en session des données de la ville en cas de sauvegarde
                $_SESSION['villeNom'] = $randCityName;
                $_SESSION['villeTaille'] = $randCitySize;
                $_SESSION['villeEnv'] = $randCitySurroundings;
                $_SESSION['villeAtout'] = $randCityLure;
                ?>

                <form class="col-lg-12 col-md-12 col-sm-12 col-xs-12 generate-form" action="autoGenerator.php" method="post">
                  <label class="col-lg-4 col-md-4 col-sm-4 col-xs-12">sauvegarder cette ville ? :</label>
                  <select name="saveToDB" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 offset-lg-1 offset-md-1 offset-sm-1">
                    <option value="oui" selected>oui</option>
                    <option value="non">non</option>
                  </select>
                  <button class="col-lg-4 col-md-4 col-sm-4 col-xs-12 btn btn-lg" type="submit">Valider</button>
                </form>

                <?php
              }
              break;

            case 'évènement':
              ?>
              <form class='col-lg-12 col-md-12 col-sm-12 col-xs-12 generate-form' name='genEvent' method='post' action='autoGenerator.php'>
                <label class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>Type d'évènement</label>
                <?php
                echo " <select name='eventType' class='col-lg-3 col-md-3 col-sm-3 col-xs-12 offset-lg-1 offset-md-1 offset-sm-1'>
                   "  . $Miawoo->selectContentGenerator("type") . " ?>
                </select> "
                ?>
                <button class="col-lg-4 col-md-4 col-sm-4 col-xs-12 btn btn-lg" type='submit' name='genEvent' >Valider</button>
              </form>
              <?php
              break;
          }
        }

        if(isset($_POST['genEvent'])) {
          $randEvent = $Miawoo->autoGenerate("évènement");
          $displayEventType = ucfirst($randEvent[0][0]);
          $displayEvent = $randEvent[1];
          ?>
          <p class="text-center">Voici un évènement aléatoire:</p>
          <div class="row city-card text-center">
            <h2 class="col-lg-12"> <?php echo "$displayEventType" ?> </h2>
            <p class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center"> <?php echo "$displayEvent" ?> </p>
          </div>
          <?php
        }

        if(isset($_SESSION['login'])) {
          if(isset($_POST['genEvent'])) {
            // stockage en session des données de l'event en cas de sauvegarde
            $_SESSION['eventType'] = $_POST['eventType'];
            $_SESSION['event'] = $randEvent[1];
            $_SESSION['userIsCreating'] = "évènement";
            ?>

            <form class="col-lg-12 col-md-12 col-sm-12 col-xs-12 generate-form" action="autoGenerator.php" method="post">
              <label class="col-lg-4 col-md-4 col-sm-4 col-xs-12">sauvegarder cet évènement ? :</label>
              <select name="saveToDB" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 offset-lg-1 offset-md-1 offset-sm-1">
                <option value="oui" selected>oui</option>
                <option value="non">non</option>
              </select>
              <button class="col-lg-4 col-md-4 col-sm-4 col-xs-12 btn btn-lg" type="submit">Valider</button>
            </form>
          <?php
          }

      }

        if(isset($_SESSION['userIsCreating'])) {
          if(isset($_POST['saveToDB'])) {
            $whatisUserCreating = $_SESSION['userIsCreating'];
            $userChoice = $_POST['saveToDB'];
            switch ($whatisUserCreating) {
              case 'personnage':
                if($userChoice == "oui") {
                  $Miawoo->createNewCharacter($_SESSION['id'], $_SESSION['persoNom'], $_SESSION['persoGenre'], $_SESSION['persoClasse'], $_SESSION['persoAge'], $_SESSION['persoElement'], $_SESSION['persoObjets']);
                  ?>
                     <p class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">Le personnage a bien été sauvegardé.</p>
                  <?php
                } else {
                  ?>
                    <p class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">Le personnage n'a pas été sauvegardé.</p>
                  <?php
                }
                break;

              case 'ville' :
                if($userChoice == "oui") {
                  $Miawoo->createNewCity($_SESSION['id'], $_SESSION['villeNom'], $_SESSION['villeTaille'], $_SESSION['villeEnv'], $_SESSION['villeAtout']);
                  ?>
                    <p class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">La ville a bien été sauvegardée.</p>
                  <?php
                } else {
                  ?>
                    <p class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">La ville n'a pas été sauvegardée.</p>
                  <?php
                }
                break;

              case 'évènement' :
                if($userChoice == "oui") {
                  $Miawoo->createNewEvent($_SESSION['id'], $_SESSION['eventType'], $_SESSION['event']);
                  ?>
                    <p class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">L'évènement a bien été sauvegardé.</p>
                  <?php
                } else {
                  ?>
                    <p class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">L'évènement n'a pas été sauvegardé.</p>
                  <?php
                }
                break;
            }
          }
          }
          ?>
    </div>
  </section>
