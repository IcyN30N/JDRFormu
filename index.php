<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta lang="fr">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
</head>

<body>
    <section class="row">
        <h1 class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">JDR FORMS</h1>
    </section>
    <section class="row">
        <h2 class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Génère moi</h2>
        <form class="col-lg-12 col-md-12 col-sm-12 col-xs-12" action="index.php" method="post">
            <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Je veux générer :</label>
            <select name="genType" class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <option value="personnage" selected>un personnage</option>
                <option value="ville">une ville</option>
                <option value="situation">une situation</option>
            </select>
            <button type="submit">Valider</button>
        </form>

        <?php
            if(isset($_POST['genType'])) {
                $selectVal = $_POST['genType'];
                echo("<h3 class='col-lg-12'>". "DEBUG ". $selectVal . "<h3>");

                function afficheForm2($selectVal) {
                  switch ($selectVal){
                      case 'personnage':
                          echo("
                              <form name='genPerso'>
                                  <label class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>formulaire de génération de personnage</label>
                                  <select name='persoGenre' class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                                      <option value='garçon' selected>je suis un garçon</option>
                                      <option value='fille'>je suis une fille</option>
                                      <option value='genderfluid'>je suis genderfluid</option>
                                      <option value='neutre'>je suis de genre neutre</option>
                                  </select>
                              </form>
                              ");
                          break;
                      case 'ville':
                          echo("
                              <form name='genVille'>
                                  <label class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>formulaire de génération de ville</label>
                                  <select name='genType' class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                                      <option value='personnage' selected>un personnage</option>
                                      <option value='ville'>une ville</option>
                                      <option value='situation'>une situation</option>
                                  </select>
                              </form>
                              ");
                          break;
                      case 'situation':
                          echo("
                              <form name='genSituation'>
                                  <label class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>formulaire de génération de situation</label>
                                  <select name='genType' class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                                      <option value='personnage' selected>un personnage</option>
                                      <option value='ville'>une ville</option>
                                      <option value='situation'>une situation</option>
                                  </select>
                              </form>
                              ");
                          break;
                      default:
                          break;
                  }
                }

                afficheForm2($selectVal);
            }
        ?>
    </section>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="JS/jdrscript.js"></script>
    </div>
</body>
</html>
