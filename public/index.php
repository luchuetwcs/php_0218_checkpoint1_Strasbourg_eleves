<?php
/**
 * Created by PhpStorm.
 * User: garniermaxime
 * Date: 29/03/2018
 * Time: 10:47
 */

require  'connect.php';
require '../SRC/functions.php';
$pdo = new PDO(DSN, USER, PASS);


$querySelect = 'SELECT * FROM civility RIGHT JOIN contact ON civility.id = contact.id_civility ORDER BY lastname ASC;';
$prep = $pdo->prepare($querySelect);
$prep -> execute();
$result = $prep->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Checkpoint1</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">

<table class="table table-bordered">
        <thead>
          <tr>
            <th>civilité</th>
            <th>NOM Prénom</th>
          </tr>
        </thead>
        <tbody>
<?php

    foreach ($result as $data){
        echo "<tr><td>".$data['civility']." "."</td>";
        echo "<td>".fullname($data['lastname'], $data['firstname'])."</td></tr>";
        }

?>
    </tbody>
</table>
</div>
</body>
</html>


