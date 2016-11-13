<?php
  session_start();
  require_once('Database.class.php');
 ?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Récupération du mot de passe</title>
	<meta name="viewport" content="width=device-width, initial scale=1">
</head>

<body>
	<section class="container-fluid text-center">
		<div class="row">
		  <h2>Récupérer mon mot de passe : </h2>
      <form class="col-lg-12 col-md-12 col-sm-12 col-xs-12" action="retrievePass.php" method="post">
        <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Mon pseudo :</label>
        <input type="text" name="pseudoToHelp">
        <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Mon adresse mail :</label>
        <input type="email" name="mailToHelp">
        <button type="submit">Valider</button>
      </form>
		</div>
        <div class="row">
            <?php
              // tableau utilisé par la fonction
              $abc = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
              // Fonction qui crée le code qui va être shippé par mail
              $magicFormula = function ($toolArray) {
                $howBigShouldItBe = rand(5,20);
                $toolArraySize = count($toolArray) - 1;
                $thisIsIt = "";
                //echo "<br> Il faut générer $howBigShouldItBe entrées<br>";
                for($i = 0; $i < $howBigShouldItBe; $i++) {
                  $randomIngredient = rand(0,$toolArraySize);
                  $thisIsIt .= "$toolArray[$randomIngredient]";
                  /*echo "<br>$randomIngredient<br>";
                  echo "$thisIsIt";*/
                }
                $optionCost = ['cost'=>12,];
                //echo "<br> non haché salé = $thisIsIt OHOHO <br>";
                $thisIsIt = password_hash($thisIsIt, PASSWORD_BCRYPT, $optionCost);
                //echo "<br>  haché salé = $thisIsIt UHUHU <br>";
                return $thisIsIt;
              };


              $Alinhavre = new Database;
                if(isset($_POST['mailToHelp']) && isset($_POST['pseudoToHelp'])) {
                  if($_POST['mailToHelp'] != "" && $_POST['pseudoToHelp'] != "") {
                    $pseudo = htmlspecialchars($_POST['pseudoToHelp']);
                    $mail = htmlspecialchars($_POST['mailToHelp']);

                    if($Alinhavre->mailCheck($mail, $pseudo)) {
  										// ENVOI D UN MAIL
                      $magicKey = $magicFormula($abc);
                      $Alinhavre->retrievePwdCodeUpdate($magicKey, $pseudo, $mail);
                      // à décommenter !!!! mail('orkalittlecutewolf@live.com','code', $magicKey,'From: jdrformu@you.com');
                      echo"Nous venons de vous envoyer un email.";
                  } else {
                    echo "Nope, cépabon.";
                  }
                  } else {
                    echo "YOU SHALL NOT PASS !";
                  }
                }
            ?>

            <?php
              if(isset($_POST['pseudoToUseWithMagicKey']) && isset($_POST['pseudoToUseWithMagicKey'])) {
                if($_POST['pseudoToUseWithMagicKey'] != "" && $_POST['magicKeyToTest'] != "") {
                  $pseudoToUseWithMagicKey = htmlspecialchars($_POST['pseudoToUseWithMagicKey']);
                  $magicKeyToTest = htmlspecialchars($_POST['magicKeyToTest']);
                  if($Alinhavre->retrievePwdCodeCheck($magicKeyToTest,$pseudoToUseWithMagicKey)) {

                  ?>
                    <p>Vous avez le droit de changer de MDP</p>
                    <form class="col-lg-12 col-md-12 col-sm-12 col-xs-12" action="retrievePass.php" method="post">
                      <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Mon pseudo :</label>
                      <input type="text" name="pseudoToUseWithNewPass">
                      <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Mon nouveau mot de passe :</label>
                      <input type="text" name="newPassword">
                      <button type="submit">Valider</button>
                    </form>
                  <?php
                  } else {
                    echo "Pas le droit de changer de MDP, vous essayez de m'avoir !!!";
                  }
                } else {
                  echo "Pas de vide !!";
                }
              } else { ?>
                <h2>Vous avez déjà un code :</h2>
                <form class="col-lg-12 col-md-12 col-sm-12 col-xs-12" action="retrievePass.php" method="post">
                  <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Mon pseudo :</label>
                  <input type="text" name="pseudoToUseWithMagicKey">
                  <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Mon code de récupération :</label>
                  <input type="text" name="magicKeyToTest">
                  <button type="submit">Valider</button>
                </form>
                <?php
              }

                if(isset($_POST['newPassword']) && $_POST['newPassword'] != "" && isset($_POST['pseudoToUseWithNewPass']) && $_POST['pseudoToUseWithNewPass'] != "") {
                  $pseudoToUseWithNewPass = htmlspecialchars($_POST['pseudoToUseWithNewPass']);
                  $newPassword = htmlspecialchars($_POST['newPassword']);
                  $optionCost = ['cost'=>12,];
                  $newHashedPassword = password_hash($newPassword, PASSWORD_BCRYPT, $optionCost);
                  $Alinhavre->passwordChange($newHashedPassword, $pseudoToUseWithNewPass);
                  $Alinhavre->retrievePwdCodeClean("",$pseudoToUseWithNewPass);
                  echo"Votre mot de passe a bien été modifié.";
                }
              ?>
        </div>
	</section>

</body>

</html>
