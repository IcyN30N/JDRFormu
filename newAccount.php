<?php
  session_start();
 ?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="">
    <title>Créa de compte</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta lang="fr">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
</head>

<body>
    <section class="container-fluid">
        <div class="row">
          <form name="newAccount" method="post" action="">
            <label>Login</label>
            <input type="text" placeholder="Juniper" name="userLogin">
            <label>Password</label>
            <input type="text" placeholder="not something too easy" name="userPwd">
            <label>Confirm your password</label>
            <input type="text" placeholder="same password" name="userPwdConfirm">
            <label>Email</label>
            <input type="email" placeholder="juniper@jdr.com" name="userMail">
            <label></label>
            <select name="preferredLangage">
              <option selected value="Fr">FR</option>
              <option value="Eng">ENG</option>
            </select>
            <button type="submit" name="newAccount">S'inscrire</button>
          </form>
        </div>
    </section>

    <?php
      if(isset($_POST['newAccount'])) {
        // stockage des données rentrées et sécurisation via htmlspecialchars
        $newUserLogin = htmlspecialchars($_POST['userLogin']);
        $newUserPwd = htmlspecialchars($_POST['userPwd']);
        $newUserPwdConfirm = htmlspecialchars($_POST['userPwdConfirm']);
        $newUserMail = htmlspecialchars($_POST['userMail']);
        $newUserLang = htmlspecialchars($_POST['preferredLangage']);

        echo"YO". $newUserLogin . $newUserPwd . $newUserPwdConfirm. $newUserMail . $newUserLang . " et voilà !!";


      }
     ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="JS/jdrscript.js"></script>

</body>
</html>
