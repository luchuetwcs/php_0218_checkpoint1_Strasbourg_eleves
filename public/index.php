<?php
      require 'connect.php';
      $pdo = new PDO(DSN, USER, PASS);

        $queryInsert = "INSERT INTO contact (firstname, lastname, civility_id) VALUES (:firstname, :lastname, :civility_id)";
        $prep2 = $pdo->prepare($queryInsert);
        $prep2->execute();



        $query = "SELECT contact.firstname, contact.lastname, civility.civility FROM contact JOIN civility ON contact.civility_id=civility.id ORDER BY contact.lastname";
        $prep = $pdo->prepare($query);
        $prep->execute();


        if ($_SERVER["REQUEST_METHOD"]==='POST') {
                if(!isset($_POST['civility']) || empty($_POST['civility']))
                {
                  $error['civility'] = "Vous n'avez pas entré votre civilité.";
                }else {
                  $prep2->bindValue(':civility',$_POST['civility'], PDO::PARAM_INT);
                }

                if(!isset($_POST['lastname']) || empty($_POST['lastname']))
                {
                  $error['lastname'] = "Vous n'avez pas entré votre nom.";
                }else {
                  $prep2->bindValue(':lastname',$_POST['lastname'], PDO::PARAM_STR);
                }

                if(!isset($_POST['firstname']) || empty($_POST['firstname']))
                {
                  $error['firstname'] = "Vous n'avez pas entré votre prénom.";
                }else {
                  $prep2->bindValue(':firstname',$_POST['firstname'], PDO::PARAM_STR);
                }

              if(empty($error))
              {
                $prep2->execute();
              }
              $prep->execute();
        }


?>

    <!DOCTYPE html>
    <html>
      <head>
        <meta charset="utf-8">
        <title>form</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      </head>
      <body>
        <div class="container">


          <form action="" method="post">
              <label for="civilite"> Civilité</label><br>
              <input type="text" name="civilite" placeholder=" 1 pour M. ou 2 pour Mme" value=""><br>
              <label for="lastname">Nom</label><br>
              <input type="text" name="lastname" placeholder="Nom" value=""><br>
              <label for="firstname">Prénom</label><br>
              <input type="text" name="firstname" placeholder="Prénom" value=""><br>
              <button type="submit" name="button">Envoyer</button><br>
          </form>

        </div>

          <table class="table">
              <thead>
                <tr>
                  <th>Civilité</th>
                  <th>NOM</th>
                  <th>Prénom</th>
                </tr>
              </thead>
              <tbody>
                <?php

                    $donnees = $prep->fetchAll();
                    foreach($donnees as $data)
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
