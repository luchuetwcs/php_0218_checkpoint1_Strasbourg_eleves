<?php 

function fullname($nom, $prenom) {
    return strtoupper($nom) . ' ' . ucwords($prenom);
}


function changement($civilite)
{
     if ($_POST['civilite'] === "M.") {
        return $_POST['civilite'] === 1;
      } elseif ($_POST['civilite'] === "Mme.") {
        return $_POST['civilite'] === 2;
      }
}