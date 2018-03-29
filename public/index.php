<?php

require '../connection/connect.php';
$pdo = new PDO(DSN, USER, PASS);

    //préparation de la requete de selection
$querySelect = 'SELECT CONCAT(lastname, " ", firstname) as fullname, civility FROM contact JOIN civility civ ON civ.id = contact.civility_id';
$prep = $pdo->query($querySelect);

    //préparation de la requete d'insertion
$queryInsert = "INSERT INTO contact (lastname, firstname, civility_id)    VALUES (:lastname, :firstname, :civility_id);";
$prep2 = $pdo->prepare($queryInsert);





?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    <table class="table table-bordered">
        <thead>
          <tr>
            <th>Civilité</th>
            <th>NOM Prénom</th>
          </tr>
        </thead>
        <tbody>
          <?php
          //on récupérer les données de l'exécution de la requete de selection
            $donnees = $prep->fetchAll();

          //on parcours le résultat pour les mettre dans la table
            foreach($donnees as $data)
          {
             
              echo "<tr><td>".$data['civility']."</td>";
              echo "<td>".$data['fullname']."</td></tr>";
          }
          ?>
        </tbody>
    </table>
    </div>
    
</body>
</html>