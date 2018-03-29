<?php

include('../src/functions.php');
define("DSN", "mysql:host=localhost;dbname=checkpoint1");
define("USER", "wilder");
define("PASS", "willphp");
$bdd = new PDO(DSN, USER, PASS);

$requete= $bdd->prepare("SELECT firstname, lastname, civility FROM contact as T INNER JOIN civility I ON I.id = T.civility_id");
$requete->execute();
$resultat= $requete->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>index</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
  <h1> Liste des contacts :</h1>
  <table class="table table-bordered">
    <caption></caption>
    <tr>
      <th><p>Civilité</p></th>
      <th><p>NOM Prénom</p></th>
    </tr>
    <?php foreach ($resultat as $key => $value) {
      $firstname = $resultat[$key]['firstname'];
      $lastname = $resultat[$key]['lastname'];

      $fullname = new functions($firstname, $lastname);
      $fullname = $fullname->fullname($firstname, $lastname);
      $civilite = $resultat[$key]['civility'];
      echo "<tr>
        <td>$civilite</td>
        <td>$fullname</td>
      </tr>";
      } ?>
  </table>
  <h1>Ajouter un contact :</h1>
  <form action="/../src/post_form.php" method="POST">
    <div>
      <label for="lastname">Votre nom :</label>
      <input type="text" id="lastname" name="lastname" value="<?= isset($_SESSION['inputs']['lastname']) ? $_SESSION['inputs']['lastname'] : ''; ?>">
    </div>
    <div>
      <label for="firstname">Votre prénom :</label>
      <input type="text" id="firstname" name="firstname" value="<?= isset($_SESSION['inputs']['firstname']) ? $_SESSION['inputs']['firstname'] : ''; ?>">
    </div>
    <label for="civility">Indiquez ici votre genre : </label>
    <select name="civility" id="civility">
      <option value="1">Homme</option>
      <option value="2">Femme</option>
    </select>
    <div class="button">
      <button type="submit">Ajouter</button>
    </div>
  </form>
</body>
</html>
