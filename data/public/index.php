<?php

require "../connect.php";

$bdd = new PDO(DSN, USER, PASS);
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$contenuCivility = $bdd->query("SELECT * FROM civility");
$contenuContact = $bdd->query("SELECT * FROM contact ORDER BY nom ASC");
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Checkpoint 1</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>

  <body>
    <h1 style="color: darkblue; text-align: center; font-size: 3em;">CHECKPOINT 1</h1>
    <div class="container">

    <h2>Contenu de la Base de Données :</h2>
    <br><br>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Civilité</th>

          <th>Nom, Prénom</th>
        </tr>
      </thead>

      <tbody>
          <?php

          $donnees = $contenuCivility->fetchAll();
          $donneesContact = $contenuContact->fetchAll();

          foreach ($donneesContact as $data)
          {
            echo "<tr><td>".$data['civility_id']."</td><td>".$data['nom']." ".$data['prenom']."</td></tr>";
          }

          ?>
        </tbody>

    </table>
  </div>

    <br><br>

     <?php

     include "form.php";

      ?>

  </body>
</html>
