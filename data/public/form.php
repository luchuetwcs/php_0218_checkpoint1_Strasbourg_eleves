<?php

require "../connect.php";

$bdd = new PDO(DSN, USER, PASS);
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//préparation de la requete de selection
$querySelect = "SELECT * FROM contact WHERE nom =:nom ;";
$prep = $bdd->prepare($querySelect);
//préparation de la requete d'insertion
$queryInsert = "INSERT INTO contact (nom, prenom)    VALUES (:nom, :prenom);";
$queryInsert2 = "INSERT INTO civilite (civilite)    VALUES (:civilite);";
$prep2 = $bdd->prepare($queryInsert);
$prep3 = $bdd->prepare($queryInsert2);


if ($_SERVER["REQUEST_METHOD"]==='POST') {

      if(!isset($_POST['id_civility']) || empty($_POST['id_civility']))
      {
        $error['civilite'] = "Vous n'avez pas entré de genre.";
      }else {
        $prep3->bindValue(':civilite',$_POST['civilite'], PDO::PARAM_STR);
      }
      if(!isset($_POST['nom']) || empty($_POST['nom']))
      {
        $error['nom'] = "Vous n'avez pas entré le titre.";
      }else {
        $prep2->bindValue(':nom',$_POST['nom'], PDO::PARAM_STR);
      }

      if(!isset($_POST['prenom']) || empty($_POST['prenom']))
      {
        $error['prenom'] = "Vous n'avez pas entré l'auteur.";
      }else {
        $prep2->bindValue(':prenom',$_POST['prenom'], PDO::PARAM_STR);
      }


      if(empty($error))
      {
        $prep2->execute();
      }
    }

    $prep->bindValue(':nom', ':prenom', PDO::PARAM_STR);
    $prep->execute();


?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Formulaire</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container">

      <h2>Créer un nouveau Contact :</h2>

      <form action="index.php" method="post">
            <label for="objet">Genre :</label>
          <select id="objet" name="genre"><br>
            <option value="homme">M.</option>
            <option value="femme">Mme.</option>
          </select><br><br>

          <label for="nom">Nom</label><br>
          <input type="text" name="nom" placeholder="Votre nom" value=""><br>
          <label for="prenom">Prenom</label><br>
          <input type="text" name="prenom" placeholder="Votre prénom" value=""><br><br>
          <button type="submit" name="button">Envoyer</button><br>
      </form>


    </div>
  </body>
</html>
