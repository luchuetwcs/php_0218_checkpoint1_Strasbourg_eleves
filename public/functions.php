<?php 

function fullname($nom, $prenom) {
    return strtoupper($nom) . ' ' . ucwords($prenom);
}