<?php
require 'connect.php';
require 'index.php';



      if ($_SERVER["REQUEST_METHOD"]==='POST') {
              if(!isset($_POST['civility']) || empty($_POST['civility']) || !preg_match("/^[a-zA-Z'. -]+$/", $_POST['user_name']))
              {
                $error['civility'] = "Vous n'avez pas entré votre civilité.";
              }else {
                $prep2->bindValue(':civility',$_POST['civility'], PDO::PARAM_STR);
              }

              if(!isset($_POST['lastname']) || empty($_POST['lastname']) || !preg_match("/^[a-zA-Z'. -]+$/", $_POST['user_name']))
              {
                $error['lastname'] = "Vous n'avez pas entré votre nom.";
              }else {
                $prep2->bindValue(':lastname',$_POST['lastname'], PDO::PARAM_STR);
              }

              if(!isset($_POST['firstname']) || empty($_POST['firstname']) || !preg_match("/^[a-zA-Z'. -]+$/", $_POST['user_name']))
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
    <title>Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container">


      <form action="" method="post">
          <label for="civilite"> Civilité</label><br>
          <input type="text" name="civilite" placeholder="Mme / M." value=""><br>
          <label for="lastname">Nom</label><br>
          <input type="text" name="lastname" placeholder="Nom" value=""><br>
          <label for="firstname">Prénom</label><br>
          <input type="text" name="firstname" placeholder="Prénom" value=""><br>
          <button type="submit" name="button">Envoyer</button><br>
      </form>

    </div>
  </body>
</html>
