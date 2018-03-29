<?php


$pdo = new PDO(DSN, USER, PASS);


function fullname($last,$first){

    return $fullname = strtoupper($last). ' ' . ucfirst($first);
    }