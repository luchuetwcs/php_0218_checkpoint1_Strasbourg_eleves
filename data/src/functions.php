<?php

require "../connect.php";
$bdd = new PDO(DSN, USER, PASS);


$prenom = $bdd->query("SELECT * FROM contact WHERE prenom=:prenom");
$nom = $bdd->query("SELECT * FROM contact ORDER BY nom ASC");

var_dump ($nom);

function fullname($fullname)
{
  $fullname = $nom." ".$prenom;
  return $fullname;
}

echo fullname();


 ?>
