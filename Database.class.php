<?php

  class Database {
    // propriétés
    //private $infoDeCo = new PDO('mysql:host=localhost;dbname=jdrformu;charset=utf8', 'root', '');
    //private $fermeture = $reqCreateAccount->closeCursor();

    public function __construct() {

    }

    // getters

    //setters

    // méthodes

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
          break;

        case 'villes':
          $req = $infoDeCo->query('SELECT * FROM villes');
          while($donnees = $req->fetch()) {
            echo "<h1> Mon attrait est ". $donnees['attrait'] . "</h1><br>";
          }
          break;

        case 'evenements':
          $req = $infoDeCo->query('SELECT * FROM evenements');
          while($donnees = $req->fetch()) {
            echo "<h1>Je m'appelle ". $donnees['evenements'] . "</h1><br>";
          }
          break;

        default:
          # code...
          break;
        }
        $req->closeCursor();
    }



  }

?>
