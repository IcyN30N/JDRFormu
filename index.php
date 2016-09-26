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
    <title>Generat0r</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
</head>

<body>
  <div class="container-fluid">
    <section class="row">
      <?php
        if(isset($_SESSION['login'])) {
          echo '<p class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right"> ' . $_SESSION['login'] . ' est connecté(e)</p>';
        }
       ?>
      <a class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right" href="login.php">vers la page de co</a>
        <h1 class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">JDR FORMS</h1>
    </section>
    <section class="row">
        <h2 class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Génère moi</h2>
        <form class="col-lg-12 col-md-12 col-sm-12 col-xs-12" action="index.php" method="post">
            <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Je veux générer :</label>
            <select name="genType" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <option value="personnage" selected>un personnage</option>
                <option value="ville">une ville</option>
                <option value="évènement">un évènement</option>
            </select>
            <button type="submit">Valider</button>
        </form>

        <?php

            $tabNomFirstPart = ["To","Num","Ork","An", "Ny"];
            $tabNomSecondPart = ["zor","gwen","hiel","ju","tia"];

            $tabItemInBag = [" une Potion"," un Sandwich", " une Loupe"," un Ordinateur"," un Appareil Photo"," un Téléphone"];

            $tabLifeEvent = ["La mine ","Le village voisin ","Tout le centre ville ","Le palais ","La cache secrète ","Un temple perdu dans les montagnes "];
            $tabLifeEvent2 = ["a pris feu","a subi les ravages d'une innondation","a vu sa rénovation terminée","a mystérieusement disparu","a vu tous ses occupants se changer en pierre","a été le théâtre d'un évènement fâcheux : un enlèvement."];
            $tabActionEvent = ["Soudain, un sorcier apparait et ","Une voleuse bondit en dehors d'un fourré et ","Avec rage, une guerrière à l'allure impressionnante ", "Un-e mort-e vivant-e "];
            $tabActionEvent2 = ["vous regarde furieusement.","jette une boule de feu.","saute sur le groupe.","sort une dague de sous sa cape.","semble psalmodier dans une langue inconnue.","hurle à tue tête que la fin du monde approche."];
            $tabTravelEvent = ["Des arbres bloquent ","Plusieurs bouts de métals acérés jonchent ","Une coulée de lave a détruit "];
            $tabTravelEvent2 = ["le chemin de terre.","l'imposant pont de pierre qui mènent à la capitale.","la totalité des fortifications."];

            // prend 2 tableaux, génère 2 nombres aléatoires et assemblent les 2 éléments sélectionnés.
            function randAssemble($arrElem1, $arrElem2) {
              $arrElem1Length = count($arrElem1) - 1;
              $arrElem2Length = count($arrElem2) - 1;
              $randomChoicePart1 = rand(0,$arrElem1Length);
              $randomChoicePart2 = rand(0,$arrElem2Length);
              $randChosenFusion = $arrElem1[$randomChoicePart1].$arrElem2[$randomChoicePart2];
              return $randChosenFusion;
            }

            // génère un âge aléatoire
            function randomAge() {
                $ageRandom = rand(1,85);
                return $ageRandom;
            }


            // sélectionne de manière pseudo aléatoire des éléments dans un tableau
            function randomSelect($arrToTreat) {
              $arrToTreatLength = count($arrToTreat) -1;
              $randomXToGenerate = rand(1,3);
              //$arrTreated = [];
              $S ="J'ai ";
              for($i = 0; $i < $randomXToGenerate; $i++) {
                //$xRandom = rand(1,$arrToTreatLength);
                $newItem = $arrToTreat[rand(1,$arrToTreatLength)];
                $S= $S . $newItem . ",";
                //array_push($arrTreated, $newItem);
              }
              //return $arrTreated;
              return $S;
            }

            // présente ce qu'il y a dans un array, non utilisée finalement
            /*function whatIsInMyArray($arrToInspect, $xInBag) {
              $howBig = count($arrToInspect) - 1;
              $jeParle = "J'ai les " . $xInBag . " que voici : ";
              for($i = 0; $i < $howBig; $i ++) {
                $jeParle+= $arrToInspect[$i];
              }
              return $jeParle;
            }
*/



            if(isset($_POST['genType'])) {
                $selectVal = $_POST['genType'];
                 //echo("<h3 class='col-lg-12'>". "DEBUG ". $selectVal . "<h3>");
                 echo("<h3 class='col-lg-12'> Continuons voulez vous ? <h3>");

                  switch ($selectVal){
                      case 'personnage':
                          echo("
                              <form name='genPerso' class='col-lg-12 col-md-12 col-sm-12 col-xs-12' action='index.php' method='post'>
                                  <label class='col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>formulaire de génération de personnage</label>
								  <label class='col-lg-4 col-md-4 col-sm-12 col-xs-12'>Genre</label>
                                  <select name='persoGenre' class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                                      <option value='garçon' selected>je suis un garçon</option>
                                      <option value='fille'>je suis une fille</option>
                                      <option value='genderfluid'>je suis genderfluid</option>
                                      <option value='neutre'>je suis de genre neutre</option>
                                  </select>
								  <label class='col-lg-4 col-md-4 col-sm-12 col-xs-12'>Classe du perso</label>
                                  <select name='persoClasse' class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                                      <option value='guerrier-re' selected>guerrier-re</option>
                                      <option value='magicien-ne'>magicien-ne</option>
                                      <option value='voleur-se'>voleur-se</option>
                                      <option value='archer-re'>archer-re</option>
                                  </select>
                                  <label class='col-lg-4 col-md-4 col-sm-12 col-xs-12'>attirance élémentaire</label>
                                  <select name='persoElement' class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                                    <option value='la terre' selected>terre</option>
                                      <option value='l'air'>air</option>
                                      <option value='le feu'>feu</option>
                                      <option value='l'eau'>eau</option>
                                  </select>
                              	<button type='submit' name='genPerso' >Valider</button>
							  </form>
                              ");
                          break;
                      case 'ville':
                          echo("
                              <form name='genVille'method='post'>
                                <label class='col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>formulaire de génération de ville</label>
                                <label class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>Taille</label>
                                <select name='villeTaille' class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                                    <option value='ville' selected>ville</option>
                                    <option value='village'>village</option>
                                    <option value='cité'>cité</option>
                                </select>
                                <label class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>Environnement</label>
                                <select name='villeEnv' class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                                    <option value='urbaine' selected>urbaine</option>
                                    <option value='montagnarde'>montagnarde</option>
                                    <option value='portuaire'>portuaire</option>
                                    <option value='aérienne'>aérienne</option>
                                    <option value='sous-marine'>sous-marine</option>
                                    <option value='forestière'>forestière</option>
                                    <option value='campagnarde'>campagnarde</option>
                                </select>
                                <label class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>Atout</label>
                                <select name='villeAtout' class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                                    <option value='aucun' selected>aucun</option>
                                    <option value='commercial'>commercial</option>
                                    <option value='touristique'>touristique</option>
                                    <option value='culturel'>culturel</option>
                                    <option value='militaire'>militaire</option>
                                </select>
                                  <button type='submit' name='genVille'>Valider</button>
                              </form>
                              ");
                          break;
                      case 'évènement':
                          echo("
                              <form name='genEvent' method='post'>
                                  <label class='col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>formulaire de génération d'évènement</label>
                                  <label class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>Type d'évènement</label>
                                  <select name='eventType' class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                                      <option value='vie' selected>vie</option>
                                      <option value='voyage'>voyage</option>
                                      <option value='action'>action</option>
                                  </select>
                                  <button type='submit' name='genEvent' >Valider</button>
                              </form>
                              ");
                          break;
                      default:
                          break;
                  }


                }

                if(isset($_POST['genPerso'])) {

                  $persoNom = randAssemble($tabNomFirstPart, $tabNomSecondPart);
                               $persoGenre = $_POST['persoGenre'];
                               $persoClasse = $_POST['persoClasse'];
                               $persoAge = randomAge();
                               $persoElement = $_POST['persoElement'];
                               $persoObjets = randomSelect($tabItemInBag);

                      //echo "<h3 class='col-lg-12'>Hey Hey, je me suis infiltré-e  !!";
                             echo "<h1 class='col-lg-12'> HEYO !  Mon nom est : " . $persoNom . "</h1>";
                             echo "<p class='col-lg-12'> Je suis une personne " . $persoGenre . ", " . $persoClasse . " de profession.</p>";
                             echo "<p class='col-lg-12'> J'ai : " . $persoAge . " ans et " . $persoElement . " m'attire beaucoup. </p>";
                             echo "<p class='col-lg-12'>  " . $persoObjets . " dans ma besace. </p>";


                             // si quelqu'un est connecté(e) on donne le choix de sauvegarder ou non ce qui a été créé
                             if(isset($_SESSION['login'])) {
                               echo ("
                                <form name='savePerso' method='post' action='index.php'>
                                  <label>sauvegarder ce personnage ?</label>
                                  <select name='choixSavePerso'>
                                    <option value='oui'>Oui</option>
                                    <option value='non'>Non</option>
                                  </select>
                                  <button type='submit' name='savePerso' >Valider</button>
                                </form>"
                              );

                              $_SESSION['persoNom'] = $persoNom;
                              $_SESSION['persoGenre'] = $persoGenre;
                              $_SESSION['persoClasse'] = $persoClasse;
                              $_SESSION['persoAge'] = $persoAge;
                              $_SESSION['persoElement'] = $persoElement;
                              $_SESSION['persoObjets'] = $persoObjets;

                             }






                          } elseif (isset($_POST['genVille'])) {
                            //  echo "<h3 class='col-lg-12'>Hey Hey, je me suis infiltré-e (genVille) !!";
                               echo "<p class='col-lg-12'> Tu as généré : " . $_POST['villeTaille'] . " " . $_POST['villeEnv'] . " . Son attrait est " . $_POST['villeAtout'] . ". </p>";

                               /*
                               if(isset($_SESSION['login'])) {
                                 echo ("
                                  <form>
                                    <label>sauvegarder cette ville ?</label>
                                    <select name='saveVille'>
                                      <option value='oui'>Oui</option>
                                      <option value='non'>Non</option>
                                    </select>
                                    <button type='submit' name='saveVille' >Valider</button>
                                  </form>"
                                );*/
                          }  elseif (isset($_POST['genEvent'])) {
                          /*    echo "<h3 class='col-lg-12'>Hey Hey, je me suis infiltré-e (genEvent) !!";
                                echo "<p class='col-lg-12'> J'ai choisi: " . $_POST['eventType'] . ". </p>"; */
                              switch ($_POST['eventType']) {
                                case 'vie':
                                  echo "<h1 class='col-lg-12'> Action obtenue :" . randAssemble($tabLifeEvent, $tabLifeEvent2) . "</h1>";
                                  break;

                                case 'voyage':
                                  echo "<h1 class='col-lg-12'> Action obtenue :" . randAssemble($tabTravelEvent, $tabTravelEvent2) . "</h1>";
                                break;

                                case 'action':
                                  echo "<h1 class='col-lg-12'> Action obtenue :" . randAssemble($tabActionEvent, $tabActionEvent2) . "</h1>";
                                break;

                                default:
                                  break;
                              }
                          }

                          if(isset($_POST['savePerso'])) {
                            $choixDeSavePerso = $_POST['choixSavePerso'];
                            echo $choixDeSavePerso;
                            if($choixDeSavePerso == 'oui') {
                              $Anzor = new Database;
                              $Anzor->createNewCharacter($_SESSION['persoNom'], $_SESSION['persoGenre'], $_SESSION['persoClasse'], $_SESSION['persoAge'], $_SESSION['persoElement'], $_SESSION['persoObjets']);
                            /*  méthode procédurale : on se connecte à la base de données avec l'objet PDO
                              $bdd = new PDO('mysql:host=localhost;dbname=jdrformu;charset=utf8', 'root', '');

                              // on prépare la requête (création d'un compte utilisateur)
                              $reqCreatePerso = $bdd->prepare('INSERT INTO personnages(nom, genre, classe, age, element, objets) VALUES(:nom, :genre, :classe, :age, :element, :objets)');
                              // on passe un tableau contenant les infos submitted par l'user pour pouvoir exécuter la requête
                              $reqCreatePerso->execute(array(
                                'nom' => $_SESSION['persoNom'],
                                'genre' => $_SESSION['persoGenre'],
                                'classe' => $_SESSION['persoClasse'],
                                'age' => $_SESSION['persoAge'],
                                'element' => $_SESSION['persoElement'],
                                'objets' =>$_SESSION['persoObjets']
                              ));
                              $reqCreatePerso->closeCursor(); */
                            } elseif($choixDeSavePerso == 'non') {
                              echo " <h1>nope nope, dommage !<h1> ";
                            }
                          }

        ?>
    </section>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="JS/jdrscript.js"></script>
    </div>
</body>
</html>
