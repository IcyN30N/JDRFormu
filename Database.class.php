<?php

  class Database {
    // propriétés

    // constructeur
    public function __construct() {

    }

    // getters

    //setters

    // méthodes

    // ---- Méthodes de Création ---- //

    public function createNewMember($login, $pass, $mail, $lang ) {
      // on prépare la requête (création d'un compte utilisateur)
      $infoDeCo = new PDO('mysql:host=localhost;dbname=jdrformu;charset=utf8', 'root', '');
      $reqCreateAccount = $infoDeCo->prepare('INSERT INTO membres(login, password, email, language) VALUES(:login, :password, :email, :language)');
      // on passe un tableau contenant les infos submitted par l'user pour pouvoir exécuter la requête
      $reqCreateAccount->execute(array(
        'login' => $login,
        'password' => $pass,
        'email' => $mail,
        'language' => $lang
      ));
      $reqCreateAccount->closeCursor();
    }

    public function createNewCharacter($nom, $genre, $classe, $age, $element, $objets) {
      // on prépare la requête (création d'un nouveau personnage)
      $infoDeCo = new PDO('mysql:host=localhost;dbname=jdrformu;charset=utf8', 'root', '');
      $reqCreatePerso = $infoDeCo->prepare('INSERT INTO personnages(nom, genre, classe, age, element, objets) VALUES(:nom, :genre, :classe, :age, :element, :objets)');
      // on passe un tableau contenant les infos submitted par l'user pour pouvoir exécuter la requête
      $reqCreatePerso->execute(array(
        'nom' => $nom,
        'genre' => $genre,
        'classe' => $classe,
        'age' => $age,
        'element' => $element,
        'objets' =>$objets
      ));
      $reqCreatePerso->closeCursor();
    }

    public function createNewCity($taille, $environnement, $attrait) {
      // on prépare la requête (création d'une nouvelle ville)
      $infoDeCo = new PDO('mysql:host=localhost;dbname=jdrformu;charset=utf8', 'root', '');
      $reqCreateCity = $infoDeCo->prepare('INSERT INTO villes(taille, environnement, attrait) VALUES(:taille, :environnement, :attrait)');
      // on passe un tableau contenant les infos submitted par l'user pour pouvoir exécuter la requête
      $reqCreateCity->execute(array(
        'taille' => $taille,
        'environnement' => $environnement,
        'attrait' => $attrait
      ));
      $reqCreateCity->closeCursor();
    }

    public function createNewEvent($type, $evenement) {
      // on prépare la requête (création d'un nouvel évènement)
      $infoDeCo = new PDO('mysql:host=localhost;dbname=jdrformu;charset=utf8', 'root', '');
      $reqCreateEvent = $infoDeCo->prepare('INSERT INTO evenements(type, evenement) VALUES(:type, :evenement)');
      // on passe un tableau contenant les infos submitted par l'user pour pouvoir exécuter la requête
      $reqCreateEvent->execute(array(
        'type' => $type,
        'evenement' => $evenement
      ));
      $reqCreateEvent->closeCursor();
    }


    // ---- Méthodes de Modification ---- //

    public function databaseChange($tableToTarget, $newDatasArray) {
      $infoDeCo = new PDO('mysql:host=localhost;dbname=jdrformu;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      switch ($tableToTarget) {
        case 'membres':
          $reqUpdateMember = $infoDeCo->prepare('UPDATE membres set password = :newPassword, email = :newEmail, language = :newLanguage WHERE login = :userLogin');
          $reqUpdateMember->execute(array(
            'newPassword' => $newDatasArray[0],
            'newEmail' => $newDatasArray[1],
            'newLanguage' => $newDatasArray[2],
            'userLogin' => $_SESSION['login']
          ));
          $reqUpdateMember->closeCursor();
          break;
        case 'personnages':
        // à compléter plus tard avec une variable contenant de quoi sélectionner un perso ( son id !)
          break;
        case 'villes':
        // à compléter plus tard avec une variable contenant de quoi sélectionner une ville ( son id !)
          # code...
          break;
        case 'evenements':
        // à compléter plus tard avec une variable contenant de quoi sélectionner un évent ( son id !)
          # code...
          break;
        default:
          # code...
          break;
      }
    }

    // ---- Méthodes de XXXX---- //

    public function loginCheck($loginToCheck) {
      $infoDeCo = new PDO('mysql:host=localhost;dbname=jdrformu;charset=utf8', 'root', '');
      $req = $infoDeCo->prepare('SELECT password FROM membres WHERE login = :login');
      $req->execute(array(
        'login' => $loginToCheck
      ));
      $donnees = $req->fetch();
      $_POST['refPass'] = $donnees['password'];
      echo"<h1>" . $_POST['refPass'] . "</h1>";
      $req->closeCursor();
    }

    public function listAll($whatShouldIListToday) {
      $infoDeCo = new PDO('mysql:host=localhost;dbname=jdrformu;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      switch ($whatShouldIListToday) {
        case 'personnages':
          $req = $infoDeCo->query('SELECT * FROM personnages');
          while($donnees = $req->fetch()) {
          echo "<h1>Je m'appelle ". $donnees['nom'] . "</h1><br>";
          }
          $req->closeCursor();
          break;

        case 'villes':
          $req = $infoDeCo->query('SELECT * FROM villes');
          while($donnees = $req->fetch()) {
            echo "<h1> Mon attrait est ". $donnees['attrait'] . "</h1><br>";
          }
          $req->closeCursor();
          break;

        case 'evenements':
          $req = $infoDeCo->query('SELECT * FROM evenements');
          while($donnees = $req->fetch()) {
            echo "<h1>Je m'appelle ". $donnees['evenement'] . "</h1><br>";
          }
          $req->closeCursor();
          break;

        default:
          # code...
          break;
        }
    }

    public function getOneMember() {
      $infoDeCo = new PDO('mysql:host=localhost;dbname=jdrformu;charset=utf8', 'root', '');
      $getMember = $infoDeCo->prepare('SELECT * FROM membres WHERE login = :login');
      $getMember->execute(array(
        'login' => $_SESSION['login']
      ));
      $donneesMember = $getMember->fetch();
      $_SESSION['password'] = $donneesMember['password'];
      $_SESSION['email'] = $donneesMember['email'];
      $_SESSION['langue'] = $donneesMember['language'];
    }



  }

?>
