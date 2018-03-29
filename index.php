<?php

include "connect.php";

if($_SERVER['REQUEST_METHOD']=='POST')
{
  print_r($_POST);

}
$connec = mysqli_connect(SERVER,USER,PASS,DB);

$req = mysqli_query($connec,'SELECT * FROM contact ORDER BY lastname DESC');
$req1 =mysqli_query($connec,'SELECT * FROM civility');
//print_r($req);

GLOBAL $nom;
GLOBAL $prenom;
GLOBAL $civil;

while ($data = mysqli_fetch_assoc($req) )
{
   $nom= $data['lastname'];
  $prenom = $data['firstname'] ."<br>";
  //echo $nom;
}
while ($donnee=mysqli_fetch_assoc($req1))
{
   $civil = $data['civility'];
}

function fullname($nom,$prenom)
  {
    $pre ="";
    $name ="";
  $pre = ucwords($prenom);
  $name = strtoupper($nom);
  echo  $pre ." ". $name;
  }



?>


<!doctype html>
<html class="no-js" lang="fr">
  <head>
    <meta charset="UTF-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" media="all">
    <link rel="stylesheet" href="css/styleform.css" media="all">
    <title>Formulaire</title>
  </head>
  <body>
    <table class="table">
      <thead>
        <tr>

          <th scope="col">Civilité</th>
          <th scope="col">NOM Prénom</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td><?php fullname($nom,$prenom); ?></td>

        </tr>
        <tr>
          <td>Jacob</td>
          <td>Thornton</td>

        </tr>
      </tbody>
    </table>
    <form action="index.php" method="post">
      <br>
      <div class="form-group">
        <label for="nom">Nom :</label>
        <input type="text" class="form-control" id="nom" />
      </div>
      <div class="form-group">
        <label for="prenom">Prenom :</label>
        <input type="text" class="form-control" id="prenom" />
      </div>

      <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>

</html>
