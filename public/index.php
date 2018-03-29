<?php

require '../connection/connect.php';
require '../src/functions.php';
$pdo = new PDO(DSN, USER, PASS);

   

    //préparation de la requete d'insertion
$queryInsert = 'INSERT INTO contact(lastname, firstname, civility_id )  VALUES (:lastname, :firstname, :civility);';
$prep2 = $pdo->prepare($queryInsert);


    // Test formulaire

    $false = '';
if ($_SERVER["REQUEST_METHOD"]==='POST') {
      //analyse des données reçues en post
      //si une donnée est reçue, on la lie à la préparation de l'Insertion
      //sinon on rentre des données dans le tableau d'erreur
      if(!isset($_POST['civility']) || empty($_POST['civility']))
      {
        $error['civility'] = "Enter civility.";
      }else {
        if ($_POST['civility']==1) {
            $prep2->bindValue(':civility',1, PDO::PARAM_INT);
        }else{
            $prep2->bindValue(':civility',2, PDO::PARAM_INT);
        }
      }

      // A REVOIR !!!!!!
      if(!isset($_POST['firstname']) || empty($_POST['firstname']))
      {
        $error['firstname'] = "Enter firstname.";
      }else {
        $prep2->bindValue(':firstname',$_POST['firstname'], PDO::PARAM_STR);
      }

      if(!isset($_POST['lastname']) || empty($_POST['lastname']))
      {
        $error['lastname'] = "Enter lastname.";
      }else {
        $prep2->bindValue(':lastname',$_POST['lastname'], PDO::PARAM_STR);
      }

      //si il n'y a pas d'erreur, on execute la requete d'insertion préparée
      if(empty($error))
      {
        $prep2->execute();
      }else{
          $false= "Tout les champs ne sont pas rempli !!";
      }
    }


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Contact</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <form action="" method="post">
            <label for="civility"> Civility</label><br>
            <select name="civility">
                <option value="1" name="M">Mr.</option>
                <option value="2" name="Mme">Mrs.</option>   
            </select><br>
            <label for="firstname"> Fistname</label><br>
            <input type="text" name="firstname" placeholder="Firstname" value=""><br>
            <label for="lastname"> lastname</label><br> 
            <input type="text" name="lastname" placeholder="Lastname" value=""><br>
            <br><h1><?php echo $false; ?></h1>
            <button type="submit">Envoyer</button><br>
        </form>
    </div>
<br>
<hr>
<br>
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

           //préparation de la requete de selection
            $querySelect = 'SELECT lastname, firstname, civility.civility FROM contact JOIN civility ON contact.civility_id = civility.id';
            $prep = $pdo->query($querySelect);
          //on récupérer les données de l'exécution de la requete de selection
            $donnees = $prep->fetchAll();

          //on parcours le résultat pour les mettre dans la table
            foreach($donnees as $data)
          {
             
              echo "<tr><td>".$data['civility']."</td>";
              echo "<td>".fullname($data['lastname'],$data['firstname'])."</td></tr>";
          }
          ?>
        </tbody>
    </table>
    </div>
    
</body>
</html>