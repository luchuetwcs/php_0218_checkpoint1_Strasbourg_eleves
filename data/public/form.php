<?php

require "../connect.php";


//préparation de la requete de selection
$querySelect = "SELECT * FROM contact WHERE nom =:nom ;";
$prep = $bdd->prepare($querySelect);
//préparation de la requete d'insertion
$queryInsert = "INSERT INTO contact (nom, prenom)    VALUES (:nom, :prenom);";
$prep2 = $bdd->prepare($queryInsert);


if ($_SERVER["REQUEST_METHOD"]==='POST') {
      //analyse des données reçues en post
      //si une donnée est reçue, on la lie à la préparation de l'Insertion
      //sinon on rentre des données dans le tableau d'erreur
      if(!isset($_POST['id_civility']) || empty($_POST['id_civility']))
      {
        $error['prenom'] = "Vous n'avez pas entré de genre.";
      }else {
        $prep2->bindValue(':nom',$_POST['nom'], PDO::PARAM_STR);
      }
      if(!isset($_POST['nom']) || empty($_POST['nom']))
      {
        $error['prenom'] = "Vous n'avez pas entré le titre.";
      }else {
        $prep2->bindValue(':nom',$_POST['nom'], PDO::PARAM_STR);
      }

      if(!isset($_POST['prenom']) || empty($_POST['prenom']))
      {
        $error['prenom'] = "Vous n'avez pas entré l'auteur.";
      }else {
        $prep2->bindValue(':prenom',$_POST['prenom'], PDO::PARAM_STR);
      }

      //si il n'y a pas d'erreur, on execute la requete d'insertion préparée
      if(empty($error))
      {
        $prep2->execute();
      }
    }
    //on lie la donnée "Luc" à la requete préparée
    $prep->bindValue(':nom', ':prenom', PDO::PARAM_STR);
    //on execute la requete de selection préparée
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

      <h1>Créer un nouveau Contact :</h1>

      <form action="form.php" method="post">
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
