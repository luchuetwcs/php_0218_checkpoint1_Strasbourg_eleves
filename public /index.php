<?php

require ('connect.php');



    $query = ('SELECT * FROM civility RIGHT JOIN contact ON civility.civility_id = contact.civility_id ORDER BY lastname DESC;');
        $prep = $pdo->prepare( $query );
        $prep->execute();
        $results = $prep->fetchAll(PDO::FETCH_ASSOC);

?>




<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
        <title>Checkpoint</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      </head>
      <body>
        <div class="container">



          <table class="table table-bordered">
            <thead>
              <tr>
                <th>civility</th>
                <th>NOM prenom</th>
              </tr>
            </thead>
            <tbody>

              <?php
              //on récupérer les données de l'exécution de la requete de selection

              //on parcours le résultat pour les mettre dans la table
              foreach($results as $data)
              {
                  echo "<tr><td>".$data['civility']."</td>";
                  echo "<td>".$data['lastname']."</td>";
                  echo "<td>".$data['firstname']."</td></tr>";
              }
              ?>
  </tbody>
</table>



  </body>
</html>
