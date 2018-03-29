<?php
//PDO
define("DSN", "mysql:host=localhost;dbname=checkpoint1");
define("USER", "wilder");
define("PASS", "08041990");

// Connection :
$pdo = new PDO(DSN, USER, PASS);

// Requête de sélection :
$requete = 'SELECT * FROM contact INNER JOIN civility ON civility.id = contact.civility_id ORDER BY firstname ASC ;';
$resultat = $pdo->prepare($requete);

//Tentative de requête d'insertion :
// Requête d'insertion :
$requete2 = "INSERT INTO contact (firstname, lastname) VALUES (:firstname, :lastname);";
$resultat2= $pdo->prepare($requete2);

if ($_SERVER["REQUEST_METHOD"]==='POST') {

  if(!isset($_POST['lastname']) || empty($_POST['lastname']))
  {
    $error['lastname'] = "Vous n'avez pas entré votre nom.";
  }else {
    $resultat2->bindValue(':lastname',$_POST['lastname'], PDO::PARAM_STR);
  }

  if(!isset($_POST['firstname']) || empty($_POST['firstname']))
  {
    $error['firstname'] = "Vous n'avez pas entré votre prénom.";
  }else {
    $resultat2->bindValue(':firstname',$_POST['firstname'], PDO::PARAM_STR);
  }

  //si il n'y a pas d'erreur, on execute la requete d'insertion préparée
  if(empty($error))
  {
    $resultat2->execute();
  }
}

/*Tentative pour lier les valeurs de la BBD et de création d'une fonction...Mais gros bordel je n'y arrive pas avec une fonction fullname :
$resultat->bindValue(':lastname',$lastname, PDO::PARAM_STR);
$resultat->bindValue(':firstname',$firstname, PDO::PARAM_STR);
$resultat->bindValue(':civility',$civility, PDO::PARAM_STR);

function fullname($lastname, $firstname){
    $first= ucwords($firstname);
    $last = strtoupper($lastname);
    $compo = $last . " " . $first;
    return $compo;
} */

// Execution de la requête préparée :
    $resultat->execute();
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
    <div class="container-fluid">

        <h1>Liste des contacts :</h1>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Civilité</th>
              <th>Nom / Prénom</th>
            </tr>
          </thead>
          <tbody>

            <?php
            //Récupération des données de l'exécution de la requete de selection :
            $resultatotal = $resultat->fetchAll();
            //Parcour du résultat :
            foreach($resultatotal as $data)
            {
                echo "<tr><td>".$data['civility']."</td>";
                echo "<td>".strtoupper($data['lastname'])." ".ucwords($data['firstname'])."</td></tr>";
            }
            ?>
          </tbody>
        </table>

        <h1>Ajouter un contact :</h1>
        <form action="beug.php" method="post">
            <div>
                <label for="lastname">Lastname :</label>
                <input type="text" id="lastname" name="lastname" value="" placeholder="Lastname" />
            </div>
            </br>
            <div>
                <label for="firstname">Firstname :</label>
                <input type="text" id="firstname" name="firstname" value="" placeholder="Firstname" />
            </div>
            </br>
            <div>
                <label for="civility">Civility :</label>
                <select name="civility" id="civility" required>
                <option value="M.">M.</option>
                <option value="Mme.">Mme.</option>
           </select>
            </div>
            </br>
            <div class="button">
                <button type="submit" name="button">Envoyer</button>
            </div>
        </form>
    </div>
</body>

</html>
