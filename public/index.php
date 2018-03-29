<?php
require 'connexion.php';
require '../src/function.php';
$pdo = new PDO(DSN, USER, PASS);


$queryInsert = "INSERT INTO contact (lastname, firstname, civility_id)    VALUES (:lastname, :firstname, :civility);";
$prep2 = $pdo->prepare($queryInsert);

if ($_SERVER["REQUEST_METHOD"]==='POST') {

  if(!isset($_POST['lastname']) || empty($_POST['lastname']))
  {
    $error['lastname'] = "Vous n'avez pas entré le nom.";
  }else {
    $prep2->bindValue(':lastname',$_POST['lastname'], PDO::PARAM_STR);
  }

  if(!isset($_POST['firstname']) || empty($_POST['firstname']))
  {
    $error['firstname'] = "Vous n'avez pas entré l'firstname.";
  }else {
    $prep2->bindValue(':firstname',$_POST['firstname'], PDO::PARAM_STR);
  }

  if(!isset($_POST['civility']) || empty($_POST['civility']))
  {
    $error['civility'] = "Vous n'avez pas entré l'firstname.";
  }else {
    $prep2->bindValue(':civility',$_POST['civility'], PDO::PARAM_STR);
    if($_POST['civility']=="M"){
      $prep2->bindValue(':civility',1, PDO::PARAM_INT);
    }
    else{
      $prep2->bindValue(':civility',2, PDO::PARAM_INT);
    }
  }

  //si il n'y a pas d'erreur, on execute la requete d'insertion préparée
  if(empty($error))
  {
    $prep2->execute();
  }
  else{
    echo "vous n'avez pas remplir les champs";
  }

}

?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Nom et prenom</th>
      <th scope="col">Civility</th>
    </tr>
  </thead>
  <tbody>

    <?php
    $query = "SELECT lastname,firstname,civility.civility FROM contact left join civility on contact.civility_id = civility.id ";
    $res = $pdo->query($query);
    $resAll = $res->fetchAll();

    foreach ($resAll as $value) {
      echo "<tr><th scope=\"row\">".fullname($value['lastname'],$value['firstname'])."</th><td>".$value['civility']."</td></tr>";}

      ?>

    </tbody>
  </table>



  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>
  <body>
    <h1 style="text-align:center;">Notre formulaire</h1>

    <form class="" action="index.php" method="post">
      <div class="col-md-6 offset-md-3">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">@</span>
          </div>
          <input type="text" class="form-control" name="lastname"placeholder="Nom" aria-label="Username" aria-describedby="basic-addon1">
        </div>
      </div>
      <div class="col-md-6 offset-md-3">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">@</span>
          </div>
          <input type="text" class="form-control" name="firstname" placeholder="Prenom" aria-label="Username" aria-describedby="basic-addon1">
        </div>
      </div>
      <div class="col-md-6 offset-md-3">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">Options</label>
          </div>

          <select name="civility"class="custom-select" id="inputGroupSelect01">
            <option selected>Civility</option>
            <option value="1" name="M">M</option>
            <option value="2" name="Mme">Mme</option>
          </select>
          <div>
          </div>
          <div class="col-md-6 offset-md-3">
            <button type="submit" class="btn btn-dark">Envoyer</button>
          </div>
        </div>

      </div>

    </form>
    <p style="text-align:right;">Realisé par zakaria zekraoui</p>
  </body>
  </html>
