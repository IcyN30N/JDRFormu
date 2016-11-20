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
  <div class="container-fluid">
    <section class="row">
      <?php
        if(isset($_SESSION['login'])) {
          echo '<p class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right"> ' . $_SESSION['login'] . ' est connecté(e)</p>';
        } ?>

        <form class="col-lg-12 col-md-12 col-sm-12 col-xs-12" action="autoGenerator.php" method="post">
            <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Je veux générer :</label>
            <select name="genType" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <option value="personnage" selected>un personnage</option>
                <option value="ville">une ville</option>
                <option value="évènement">un évènement</option>
            </select>
            <button type="submit">Valider</button>
        </form>

        <?php
        $Miawoo = new Database;
        if(isset($_POST['genType'])) {
          $selectVal = $_POST['genType'];
          echo "$selectVal";
          switch ($selectVal) {
            case 'personnage':
              $randChar = $Miawoo->autoGenerate("personnage");
              var_dump($randChar);
              
              /* S INSPIRER POUR ENVOYER DES INFOS SUR LE PERSO GEN echo "<h1>Je m'appelle $randCharName, je suis de genre $randCharGender[1]. Je suis $randCharClass[1], j'ai $randCharAge ans et j'ai une attirance pour $randCharElement[1].</h1>"; */

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

                <form class="col-lg-12 col-md-12 col-sm-12 col-xs-12" action="autoGenerator.php" method="post">
                  <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2">sauvegarder ce personnage ? :</label>
                  <select name="saveToDB" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <option value="oui" selected>oui</option>
                    <option value="non">non</option>
                  </select>
                  <button type="submit">Valider</button>
                </form>

                <?php
                }
              break;

            case 'ville':
              $randCity = $Miawoo->autoGenerate("ville");
              var_dump($randCity);

              /* S INSPIRER POUR ENVOYER DES INFOS SUR LA VILLE GEN  echo "<h1>Bienvenue à $randCityName. Je suis $randCitySize[1] et j'ai pour environnement  $randCitySurroundings[1] et mon attrait est $randCityLure[1]</h1>"; */

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

                <form class="col-lg-12 col-md-12 col-sm-12 col-xs-12" action="autoGenerator.php" method="post">
                  <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2">sauvegarder cette ville ? :</label>
                  <select name="saveToDB" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <option value="oui" selected>oui</option>
                    <option value="non">non</option>
                  </select>
                  <button type="submit">Valider</button>
                </form>

                <?php
              }
              break;

            case 'évènement':
              ?>
              <form name='genEvent' method='post' action='autoGenerator.php'>
                <label class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>Type d'évènement</label>
                <?php
                echo " <select name='eventType' class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                   "  . $Miawoo->selectContentGenerator("type") . " ?>
                </select> "
                ?>
                <button type='submit' name='genEvent' >Valider</button>
              </form>
              <?php
              break;
          }
        }

        if(isset($_POST['genEvent'])) {
          $randEvent = $Miawoo->autoGenerate("évènement");
          echo "$randEvent";
        }

        if(isset($_SESSION['login'])) {
          if(isset($_POST['genEvent'])) {
            // stockage en session des données de l'event en cas de sauvegarde
            $_SESSION['eventType'] = $_POST['eventType'];
            $_SESSION['event'] = $randEvent;
            $_SESSION['userIsCreating'] = "évènement";
            ?>

            <form class="col-lg-12 col-md-12 col-sm-12 col-xs-12" action="autoGenerator.php" method="post">
              <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2">sauvegarder cet évènement ? :</label>
              <select name="saveToDB" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <option value="oui" selected>oui</option>
                <option value="non">non</option>
              </select>
              <button type="submit">Valider</button>
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
                    echo "Le personnage a bien été sauvegardé.";
                } else {
                    echo "Le personnage n'a pas été sauvegardé.";
                }
                break;

              case 'ville' :
                if($userChoice == "oui") {
                  $Miawoo->createNewCity($_SESSION['id'], $_SESSION['villeNom'], $_SESSION['villeTaille'], $_SESSION['villeEnv'], $_SESSION['villeAtout']);
                  echo "La ville a bien été sauvegardée.";
                } else {
                  echo "La ville n'a pas été sauvegardée.";
                }
                break;

              case 'évènement' :
                if($userChoice == "oui") {
                  $Miawoo->createNewEvent($_SESSION['id'], $_SESSION['eventType'], $_SESSION['event']);
                  echo "L'évènement a bien été sauvegardé.";
                } else {
                  echo "L'évènement n'a pas été sauvegardé.";
                }
                break;
            }
          }
          }
          ?>
    </section>
  </div>
